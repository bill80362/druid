<?php

namespace App\ExcelImport\Goods;

use App\Models\Goods;
use Maatwebsite\Excel\Concerns\ToCollection;

class GoodsSheetImport implements ToCollection
{
    public function collection(\Illuminate\Support\Collection $collection)
    {
        foreach ($collection as $key => $row){
            //
            if($key==0) continue;
            if(!is_int($row[0])) continue;
            //
            $goods = Goods::where("id",$row[0])->firstOrNew();
            $goods->name = $row[1];
            $goods->sku = $row[2];
            $goods->price = (int)$row[3];
            $goods->status = $row[4]?:"Y";
            $goods->sort = $row[5]?:1;
            $goods->content1 = $row[6];
            $goods->save();
        }
    }
}
