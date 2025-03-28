<?php

namespace App\ExcelImport\Goods;

use App\Models\GoodsPhoto;
use App\Models\SpecOption;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GoodsImport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        return [
            "電商主商品" => new GoodsSheetImport(),
            "規格群組" => new SpecSheetImport(),
            "規格選項" => new SpecOptionSheetImport(),
            "商品明細" => new GoodsDetailSheetImport(),
            "商品圖片" => new GoodsPhotoSheetImport(),
        ];
    }
}
