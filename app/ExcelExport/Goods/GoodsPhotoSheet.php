<?php

namespace App\ExcelExport\Goods;

use App\Models\Goods;
use App\Models\GoodsPhoto;
use App\Models\Spec;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class GoodsPhotoSheet implements FromQuery, WithTitle , WithHeadings
{
    public function title(): string
    {
        return '商品圖片';
    }
    public function query()
    {
        return GoodsPhoto::select(["id","goods_id","name","sort"]);
    }
    public function headings(): array
    {
        return [
            '編號', '主編號商品', '圖片路徑', "排序"
        ];
    }
}
