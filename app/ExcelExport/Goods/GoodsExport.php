<?php

namespace App\ExcelExport\Goods;

use App\Models\Spec;
use App\Models\SpecOption;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GoodsExport implements WithMultipleSheets
{
    use Exportable;

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        //
        $sheets[] = new GoodsSheet();
        $sheets[] = new SpecSheet();
        $sheets[] = new SpecOptionSheet();
        $sheets[] = new GoodsDetailSheet();
        return $sheets;
    }
}
