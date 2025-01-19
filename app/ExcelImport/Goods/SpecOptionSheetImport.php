<?php

namespace App\ExcelImport\Goods;

use App\Models\Spec;
use App\Models\SpecOption;
use Maatwebsite\Excel\Concerns\ToCollection;

class SpecOptionSheetImport implements ToCollection
{
    public function collection(\Illuminate\Support\Collection $collection)
    {
        foreach ($collection as $key => $row){
            //
            if($key==0) continue;
            if(!is_int($row[0])) continue;
            //
            $item = SpecOption::where("id",$row[0])->firstOrNew();
            $item->name = $row[1];
            $item->sku = $row[2];
            $item->content = $row[3];
            $item->status = $row[4]?:"Y";
            $item->sort = $row[5]?:1;
            $item->spec_id = $row[6];
            $item->save();
        }
    }
}
