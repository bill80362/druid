<?php

namespace App\ExcelImport\Goods;

use App\Models\Spec;
use Maatwebsite\Excel\Concerns\ToCollection;

class SpecSheetImport implements ToCollection
{
    public function collection(\Illuminate\Support\Collection $collection)
    {
        foreach ($collection as $key => $row){
            //
            if($key==0) continue;
            if(!is_int($row[0])) continue;
            //
            $goods = Spec::where("id",$row[0])->firstOrNew();
            $goods->name = $row[1];
            $goods->content = $row[2];
            $goods->save();
        }
    }
}
