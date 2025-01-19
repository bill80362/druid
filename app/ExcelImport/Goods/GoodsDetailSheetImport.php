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
        $specOptions = SpecOption::get()->keyBy("id")->toArray();
//        dd($specOptions);
        //
        foreach ($collection as $key => $row){
            //
            if($key==0) continue;
            if(!is_int($row[0])) continue;
            //
            $item = GoodsDetail::where("id",$row[0])->firstOrNew();
            $item->goods_id = $row[1];
            $item->name = $row[2];
            $item->sku = $row[3];
            $item->price = (int)$row[4];
            $item->status = $row[5]?:"Y";
            $item->sort = $row[6]?:1;
            $item->save();
            //
            $syncOptions = [];
            if($row[7]){
                $syncOptions = collect(explode(",",$row[7]))?->mapWithKeys(function ($i)use($specOptions){
                        if(!$i) return null;
                        return [$i=>["spec_id"=>($specOptions[$i]["spec_id"]??"")]];
                    })?->toArray()??[];
            }
            $item->specOptions()->sync($syncOptions);
        }
    }
}
