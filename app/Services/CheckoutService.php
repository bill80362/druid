<?php

namespace App\Services;

use App\Models\Discount;
use App\Models\Level;

class CheckoutService
{
    public array $discountLogs = [];
    public int $levelPoint = 0;
    public function cashier($shoppingCartGoodsItems, $discounts, $level_id)
    {
        //初始化價格
        $shoppingCartGoodsItems->load(["goodsDetail"]);
        $shoppingCartGoodsItems->transform(function ($item) {
            $item->discount_price = $item->goodsDetail->price;
            $this->discountLogs = [];
            return $item;
        });
        //經過折扣後
        foreach ($discounts as $discount) {
            $pass=false;
            if($discount->event_type=="N"){
                $pass = true;
            }elseif($discount->event_type=="M" &&  ((int)$discount->event_count_threshold) > $shoppingCartGoodsItems->count()){
                $pass = true;
            }elseif($discount->event_type=="C" &&  ((int)$discount->event_money_threshold) > $shoppingCartGoodsItems->sum("goodsDetail.price")){
                $pass = true;
            }elseif($discount->event_type=="E"){
                if( ((int)$discount->event_count_threshold) > $shoppingCartGoodsItems->count() || ((int)$discount->event_money_threshold) > $shoppingCartGoodsItems->sum("goodsDetail.price") ){
                    $pass = true;
                }
            }elseif($discount->event_type=="B"){
                if( ((int)$discount->event_count_threshold) > $shoppingCartGoodsItems->count() && ((int)$discount->event_money_threshold) > $shoppingCartGoodsItems->sum("goodsDetail.price") ){
                    $pass = true;
                }
            }
            //
            if(!$pass){
                continue;
            }
            //
            $shoppingCartGoodsItems->transform(function ($item) use ($discount) {
                //
                if($discount->discount_type=="M" && $discount->discount_money > 0){
                    //折扣金額
                    $new = $item->discount_price-$discount->discount_money;
                    $new = max($new,0);
                    $item->discount_price = min($item->discount_price,$new);
                    $this->discountLogs[$item->id][] = $discount->toArray();
                    //
                }elseif($discount->discount_type=="R" && $discount->discount_ratio > 0){
                    //打折
                    $new = $item->discount_price*$discount->discount_ratio/100;
                    $new = max($new,0);
                    $item->discount_price = min($item->discount_price,$new);
                    $this->discountLogs[$item->id][] = $discount->toArray();
                }elseif($discount->discount_type=="S" && $discount->discount_static > 0){
                    //固定
                    $new = $discount->discount_static;
                    $new = max($new,0);
                    $item->discount_price = min($item->discount_price,$new);
                    $this->discountLogs[$item->id][] = $discount->toArray();
                }
                //
                return $item;
            });
        }
        //計算等級贈點
        $final_price = $shoppingCartGoodsItems->sum("discount_price");
        $level = Level::find($level_id);
        if($level?->point_from_money){
            $this->levelPoint = floor($final_price/$level->point_from_money);
        }
        //
        return $shoppingCartGoodsItems;
    }
}
