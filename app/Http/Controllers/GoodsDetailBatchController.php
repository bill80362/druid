<?php

namespace App\Http\Controllers;

use App\Models\GoodsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GoodsDetailBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('商品明細管理_讀取')) {
            abort(403);
        }
        //
        $items = GoodsDetail::user()->orderBy("sku")->get();
        //
        return view('goods_detail.batch',[
            "items" => $items,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if (! Gate::allows('商品明細管理_修改')) {
            abort(403);
        }
        //
        $errorMessage = [];
        $items = $request->get("goods_detail_update");
        foreach ($items as $id => $item){
            //
            if(empty($item["sku"])) continue;
            //sku不能重複
            $check = GoodsDetail::where("sku",$item["sku"]??"")->where("id","!=",$id)->first();
            if($check){
                $errorMessage[] = "SKU重複(".($item["sku"]??"").")";
                continue;
            }
            if(empty($item["name"])){
                $errorMessage[] = "商品".($item["sku"]??"")."錯誤，名稱為必填";
                continue;
            }
            if(empty($item["price"])){
                $errorMessage[] = "商品".($item["sku"]??"")."錯誤，價格為必填";
                continue;
            }
            if(!is_numeric($item["price"]) || $item["price"]<=0){
                $errorMessage[] = "商品".($item["sku"]??"")."錯誤，價格必須為正整數";
                continue;
            }
            //
            $goodsDetail = GoodsDetail::find($id);
            $goodsDetail->name = $item["name"]??"";
            $goodsDetail->sku = $item["sku"]??"";
            $goodsDetail->price = $item["price"]??"";
            $goodsDetail->status = $item["status"]??"";
            $goodsDetail->save();
        }
        //新增
        $items = $request->get("goods_detail_create");
        foreach ($items["name"]??[] as $index => $value){
            //
            if(empty($items["sku"][$index])) continue;
            //sku不能重複
            $check = GoodsDetail::where("sku",$items["sku"][$index]??"")->where("id","!=",$id)->first();
            if($check){
                $errorMessage[] = "SKU重複(".($items["sku"][$index]??"").")";
                continue;
            }
            if(empty($items["name"][$index])){
                $errorMessage[] = "商品".($items["sku"][$index]??"")."錯誤，名稱為必填";
                continue;
            }
            if(empty($items["price"][$index])){
                $errorMessage[] = "商品".($items["sku"][$index]??"")."錯誤，價格為必填";
                continue;
            }
            if(!is_numeric($items["price"][$index]) || $items["price"][$index]<=0){
                $errorMessage[] = "商品".($items["sku"][$index]??"")."錯誤，價格必須為正整數";
                continue;
            }
            $goodsDetail = new GoodsDetail();
            $goodsDetail->name = $items["name"][$index]??"";
            $goodsDetail->sku = $items["sku"][$index]??"";
            $goodsDetail->price = $items["price"][$index]??"";
            $goodsDetail->status = "N";
            $goodsDetail->save();
        }
        //
        return redirect()->route('goods_details.batch.index')->with("success",["儲存完成，".implode(",",$errorMessage)]);
    }
}
