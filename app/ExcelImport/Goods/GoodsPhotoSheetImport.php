<?php

namespace App\ExcelImport\Goods;

use App\Models\Goods;
use App\Models\GoodsDetail;
use App\Models\GoodsPhoto;
use App\Models\SpecOption;
use Maatwebsite\Excel\Concerns\ToCollection;

class GoodsPhotoSheetImport implements ToCollection
{
    public function collection(\Illuminate\Support\Collection $collection)
    {
        //
        foreach ($collection as $key => $row){
            //
            if($key==0) continue;
            if(!is_int($row[0])) continue;
            //
            $goods = GoodsPhoto::where("id",$row[0])->firstOrNew();
            $goods->goods_id = $row[1];
            $goods->name = $row[2];
            $goods->sort = $row[3]?:1;
            $goods->save();
        }
    }
}
