<?php

namespace App\Http\Controllers;

use App\Models\GoodsDetail;
use App\Models\Member;
use App\Models\Payment;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartGoods;
use App\Models\ShoppingPayment;

class CheckoutController extends Controller
{
    public function checkout()
    {
        //購物車商品
        $shoppingCartGoodsItems = ShoppingCartGoods::with(["goodsDetail"])->where("user_id", auth()->user()->id)->get();
        //
        $shoppingCartPaymentItems = ShoppingPayment::with(["payment"])->get();
        //購物車付款方式
        $shoppingCard = ShoppingCart::where("user_id",auth()->user()->id)->first();
        //結帳會員
        $member = Member::find($shoppingCard?->data["member_id"]??"");

        //
        return view('checkout/checkout', [
            "shoppingCartGoodsItems" => $shoppingCartGoodsItems,
            "shoppingCartPaymentItems" => $shoppingCartPaymentItems,
            "shoppingCard" => $shoppingCard,
            "member" => $member,
            "paymentItems" => Payment::where("status","Y")->get(),
        ]);
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
        $data = $shoppingCard->data??[];
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
        $data = $shoppingCard->data??[];
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
        if(request()->get("money")<0)
        {
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
