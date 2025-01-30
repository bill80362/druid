<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\GoodsDetail;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPayment;
use App\Models\Payment;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartGoods;
use App\Models\ShoppingPayment;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutService $checkoutService)
    {
        //購物車
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->first();
        //購物車商品
        $shoppingCartGoodsItems = ShoppingCartGoods::with(["goodsDetail"])->where("user_id", auth()->user()->id)->get();
        //購物車結帳
        $shoppingCartPaymentItems = ShoppingPayment::with(["payment"])->where("user_id", auth()->user()->id)->get();
        //結帳會員
        $member = Member::find($shoppingCard?->data["member_id"] ?? "");
        //折扣規則
        $discounts = Discount::where("status","Y")->orderBy("sort")->get();
        //優惠計算
        $shoppingCartGoodsItems = $checkoutService->cashier($shoppingCartGoodsItems,$discounts);
        $discountLogs = $checkoutService->discountLogs;
        //
        return view('checkout/checkout', [
            "shoppingCartGoodsItems" => $shoppingCartGoodsItems,
            "shoppingCartPaymentItems" => $shoppingCartPaymentItems,
            "shoppingCard" => $shoppingCard,
            "member" => $member,
            "paymentItems" => Payment::where("status", "Y")->orderBy("sort")->get(),
            "discountLogs" => $discountLogs,
        ]);
    }

    public function finish(CheckoutService $checkoutService,Request $request)
    {
        //購物車
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->first();
        $shoppingCartGoodsItems = ShoppingCartGoods::with(["goodsDetail"])->where("user_id", auth()->user()->id)->get();
        $shoppingCartPaymentItems = ShoppingPayment::with(["payment"])->where("user_id", auth()->user()->id)->get();
        //折扣規則
        $discounts = Discount::where("status","Y")->orderBy("sort")->get();
        //優惠計算
        $shoppingCartGoodsItems = $checkoutService->cashier($shoppingCartGoodsItems,$discounts);
        $discountLogs = $checkoutService->discountLogs;
        //驗證購物車
        if (!$shoppingCartGoodsItems?->count()) {
            return redirect()->route("checkout.checkout")->with("success", ["購物車無商品"]);
        }
        if ($shoppingCartGoodsItems->sum("discount_price") != $shoppingCartPaymentItems->sum("money")) {
            return redirect()->route("checkout.checkout")->with("success", ["購物車結帳金額與付款金額不符"]);
        }
        //建立訂單
        $order = new Order();
        $order->status = "finish";
        $order->detail_subtotal = $shoppingCartGoodsItems->sum("discount_price");
        $order->total = $shoppingCartGoodsItems->sum("discount_price");
        $order->memo = $request->get("memo");
        $order->member_id = $shoppingCard?->data["member_id"] ?? null;
        $order->user_id = auth()->user()->id;
        $order->save();
        //
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
        //
        $orderPayments = $shoppingCartPaymentItems->map(function ($item) {
            $payment = $item->payment;
            $orderPayment = new OrderPayment();
            $orderPayment->payment_id = $item->payment_id;
            $orderPayment->status = "Y";
            $orderPayment->type = $payment->type;
            $orderPayment->money = $payment->money;
            $orderPayment->memo = $payment->memo;
            return $orderPayment;
        });
        $order->orderPayments()->saveMany($orderPayments);
        //清空購物車
        $shoppingCard->data = [];
        $shoppingCard->save();
        $shoppingCartGoodsItems->map(fn($i) => $i->delete());
        $shoppingCartPaymentItems->map(fn($i) => $i->delete());
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
}
