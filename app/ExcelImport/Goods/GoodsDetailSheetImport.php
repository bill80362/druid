<?php

namespace App\ExcelImport\Goods;

use App\Models\Goods;
use App\Models\GoodsDetail;
use App\Models\SpecOption;
use Maatwebsite\Excel\Concerns\ToCollection;

class GoodsDetailSheetImport implements ToCollection
{
    public function collection(\Illuminate\Support\Collection $collection)
    {
        //
        $specOptions = SpecOption::get()->keyBy("id");
        //
        foreach ($collection as $key => $row){
            //
            if($key==0) continue;
            if(!is_int($row[0])) continue;
            //
            $goods = GoodsDetail::where("id",$row[0])->firstOrNew();
            $goods->goods_id = $row[1];
            $goods->name = $row[2];
            $goods->sku = $row[3];
            $goods->price = (int)$row[4];
            $goods->status = $row[5]?:"Y";
            $goods->sort = $row[6]?:1;
            $goods->save();
        }
    }
}
