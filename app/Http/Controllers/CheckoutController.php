<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\GoodsDetail;
use App\Models\Level;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPayment;
use App\Models\Payment;
use App\Models\Point;
use App\Models\Setting;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartGoods;
use App\Models\ShoppingPayment;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutService $checkoutService)
    {
        //系統設定
        $setting = Setting::where("id","1")->first();
        $systemSetting = $setting?->content;
        $pointToMoney = $systemSetting["point_to_money"]??1;
        //購物車
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->first();
        //購物車商品
        $shoppingCartGoodsItems = ShoppingCartGoods::with(["goodsDetail"])->where("user_id", auth()->user()->id)->get();
        //購物車結帳
        $shoppingCartPaymentItems = ShoppingPayment::with(["payment"])->where("user_id", auth()->user()->id)->get();
        //結帳會員
        $member = Member::withSum('points','point')->find($shoppingCard?->data["member_id"] ?? "");
        //折扣規則
        $discounts = Discount::where("status", "Y")->orderBy("sort")->get();
        //優惠計算member_use_point
        $shoppingCartGoodsItems = $checkoutService->cashier($shoppingCartGoodsItems, $discounts, $member?->level_id);
        $discountLogs = $checkoutService->discountLogs;
        $levelPoint = $checkoutService->levelPoint;
        //
        $memberUsePoint = $shoppingCard?->data["member_use_point"]??0;
        //
        return view('checkout/checkout', [
            "shoppingCartGoodsItems" => $shoppingCartGoodsItems,
            "shoppingCartPaymentItems" => $shoppingCartPaymentItems,
            "shoppingCard" => $shoppingCard,
            "member" => $member,
            "paymentItems" => Payment::where("status", "Y")->orderBy("sort")->get(),
            "discountLogs" => $discountLogs,
            "levelPoint" => $levelPoint,
            "memberUsePoint" => $memberUsePoint,
            "pointToMoney" => $pointToMoney,
        ]);
    }

    public function finish(CheckoutService $checkoutService, Request $request)
    {
        //系統設定
        $setting = Setting::where("id","1")->first();
        $systemSetting = $setting?->content;
        $pointToMoney = $systemSetting["point_to_money"]??1;
        //購物車
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->first();
        $shoppingCartGoodsItems = ShoppingCartGoods::with(["goodsDetail"])->where("user_id", auth()->user()->id)->get();
        $shoppingCartPaymentItems = ShoppingPayment::with(["payment"])->where("user_id", auth()->user()->id)->get();
        //折扣規則
        $discounts = Discount::where("status", "Y")->orderBy("sort")->get();
        //優惠計算
        $member = Member::find($shoppingCard?->data["member_id"] ?? "");
        $shoppingCartGoodsItems = $checkoutService->cashier($shoppingCartGoodsItems, $discounts, $member?->level_id);
        $discountLogs = $checkoutService->discountLogs;
        $levelPoint = $checkoutService->levelPoint;
        //使用點數
        $memberUsePoint = $shoppingCard?->data["member_use_point"]??0;
        //驗證購物車
        if (!$shoppingCartGoodsItems?->count()) {
            return redirect()->route("checkout.checkout")->with("success", ["購物車無商品"]);
        }
        if ( ($shoppingCartGoodsItems->sum("discount_price")-$memberUsePoint*$pointToMoney) != $shoppingCartPaymentItems->sum("money")) {
            return redirect()->route("checkout.checkout")->with("success", ["購物車結帳金額與付款金額不符"]);
        }
        //建立訂單
        $order = new Order();
        $order->status = "finish";
        $order->detail_subtotal = $shoppingCartGoodsItems->sum("discount_price");
        $order->total = $shoppingCartGoodsItems->sum("discount_price")-$memberUsePoint*$pointToMoney;
        $order->memo = $request->get("memo");
        $order->member_id = $shoppingCard?->data["member_id"] ?? null;
        $order->user_id = auth()->user()->id;
        $order->save();
        //商品明細
        $orderDetails = $shoppingCartGoodsItems->map(function ($item) {
            $goodsDetail = $item->goodsDetail;
            $orderDetail = new OrderDetail();
            $orderDetail->name = $goodsDetail->name;
            $orderDetail->goods_sku = $goodsDetail->sku;
            $orderDetail->goods_detail_id = $goodsDetail->id;
            $orderDetail->price_origin = $goodsDetail->price;
            $orderDetail->price = $item->price;
            return $orderDetail;
        });
        $order->orderDetails()->saveMany($orderDetails);
        //付款方式
        $orderPayments = $shoppingCartPaymentItems->map(function ($item) {
            $payment = $item->payment;
            $orderPayment = new OrderPayment();
            $orderPayment->payment_id = $item->payment_id;
            $orderPayment->status = "Y";
            $orderPayment->type = $payment->type;
            $orderPayment->money = $item->money;
            $orderPayment->memo = $item->memo;
            return $orderPayment;
        });
        $order->orderPayments()->saveMany($orderPayments);
        //會員等級贈點
        $member = Member::with(["level"])->find($shoppingCard?->data["member_id"] ?? "");
        if ($member && $levelPoint) {
            $pointItem = new Point();
            $pointItem->name = "會員等級贈點";
            $pointItem->member_id = $member->id;
            $pointItem->order_id = $order->id;
            $pointItem->point = $levelPoint;
            $pointItem->save();
        }
        //清空購物車
        $shoppingCard->data = [];
        $shoppingCard->save();
        $shoppingCartGoodsItems->map(fn($i) => $i->delete());
        $shoppingCartPaymentItems->map(fn($i) => $i->delete());
        //計算會員是否升等
        $orders_sum_total = Order::where("member_id",$member->id)->sum("total");
        if($member->level->upgrade > $orders_sum_total){
            //升等
            $level = Level::where("sort",">",$member->level->sort)->orderBy("sort")->first();
            if(!$level?->id){
                $member->level_id = $level?->id;
                $member->save();
            }
        }

        //檢查訂單金額
        return redirect()->route("checkout.checkout")->with("success", ["結帳完成"]);
    }

    public function addGoods()
    {
        //
        $item = GoodsDetail::where("sku", request()->get("goods_detail_sku"))->first();
        if (!$item) {
            return back()->with("success", ["sku異常"]);
        }
        //
        $shoppingCardGoods = new ShoppingCartGoods();
        $shoppingCardGoods->user_id = auth()->user()->id;
        $shoppingCardGoods->goods_detail_id = $item->id;
        $shoppingCardGoods->save();
        //
        return redirect()->route("checkout.checkout")->with("success", ["新增商品成功"]);
    }

    public function removeGoods()
    {
        //
        $shoppingCardGoods = ShoppingCartGoods::find(request()->get("id"));
        $shoppingCardGoods->delete();
        //
        return redirect()->route("checkout.checkout")->with("success", ["移除商品成功"]);
    }

    public function setMember()
    {
        //
        $item = Member::where("slug", request()->get("member_slug"))->first();
        if (!$item) {
            return back()->with("success", ["卡號異常"]);
        }
        //
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->firstOrNew();
        $shoppingCard->user_id = auth()->user()->id;
        $data = $shoppingCard->data ?? [];
        $data["member_id"] = $item->id;
        $data["member_use_point"] = 0;
        $shoppingCard->data = $data;
        $shoppingCard->save();
        //
        return redirect()->route("checkout.checkout")->with("success", ["結帳會員設定成功"]);
    }

    public function resetMember()
    {
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->firstOrNew();
        $shoppingCard->user_id = auth()->user()->id;
        $data = $shoppingCard->data ?? [];
        $data["member_id"] = "";
        $data["member_use_point"] = 0;
        $shoppingCard->data = $data;
        $shoppingCard->save();
        //
        return redirect()->route("checkout.checkout")->with("success", ["結帳會員取消成功"]);
    }

    public function addPayment()

    {
        //
        $item = Payment::find(request()->get("payment_id"));
        if (!$item) {
            return back()->with("success", ["支付方式異常"]);
        }
        if (!request()->get("money")) {
            return back()->with("success", ["支付金額異常"]);
        }
        if (request()->get("money") < 0) {
            return back()->with("success", ["支付金額需要大於0"]);
        }
        //
        $shoppingPayment = new ShoppingPayment();
        $shoppingPayment->user_id = auth()->user()->id;
        $shoppingPayment->payment_id = $item->id;
        $shoppingPayment->money = request()->get("money");
        $shoppingPayment->memo = request()->get("memo");
        $shoppingPayment->save();
        //
        return redirect()->route("checkout.checkout")->with("success", ["支付方式新增成功"]);
    }

    public function removePayment()
    {
        //
        $item = ShoppingPayment::find(request()->get("id"));
        $item->delete();
        //
        return redirect()->route("checkout.checkout")->with("success", ["移除付款方式成功"]);
    }
    public function usePoint(Request $request)
    {
        //
        $item = Member::withSum('points','point')->where("slug", request()->get("member_slug"))->first();
        if ( ((int)$item?->points_sum_point) < $request->get("use_point")) {
            return back()->with("success", ["點數不足"]);
        }
        //
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->firstOrNew();
        $shoppingCard->user_id = auth()->user()->id;
        $data = $shoppingCard->data ?? [];
        $data["member_use_point"] = $request->get("use_point");
        $shoppingCard->data = $data;
        $shoppingCard->save();
        //
        if($request->get("use_point")){
            return redirect()->route("checkout.checkout")->with("success", ["使用點數成功"]);
        }else{
            return redirect()->route("checkout.checkout")->with("success", ["移除點數成功"]);
        }

    }
}
