<?php

namespace App\Http\Controllers;

use App\Models\GoodsDetail;
use App\Models\Member;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartGoods;

class CheckoutController extends Controller
{
    public function checkout()
    {
        //購物車商品
        $shoppingCartGoodsItems = ShoppingCartGoods::with(["goodsDetail"])->where("user_id", auth()->user()->id)->get();
        //購物車付款方式
        $shoppingCard = ShoppingCart::find(auth()->user()->id);
        //結帳會員
        $member = Member::find($shoppingCard->data["member_id"]??"");

        //
        return view('checkout/checkout', [
            "shoppingCartGoodsItems" => $shoppingCartGoodsItems,
            "shoppingCard" => $shoppingCard,
            "member" => $member,
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
        $shoppingCardGoods = ShoppingCartGoods::where("user_id", auth()->user()->id)->where("goods_detail_id", $item->id)->firstOrNew();
        $shoppingCardGoods->user_id = auth()->user()->id;
        $shoppingCardGoods->goods_detail_id = $item->id;
        $shoppingCardGoods->save();
        //
        return redirect()->route("checkout.checkout");
    }

    public function setMember()
    {
        //
        $item = Member::where("sku", request()->get("member_slug"))->first();
        if (!$item) {
            return back()->with("success", ["卡號異常"]);
        }
        //
        $shoppingCard = ShoppingCart::where("user_id", auth()->user()->id)->firstOrNew();
        $shoppingCard->user_id = auth()->user()->id;
        $shoppingCard->data["member_id"] = $item->id;
        $shoppingCard->save();
    }
}
