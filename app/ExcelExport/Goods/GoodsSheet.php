<?php

namespace App\ExcelExport\Goods;

use App\Models\Goods;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class GoodsSheet implements FromQuery, WithTitle, WithHeadings
{
    public function title(): string
    {
        return '電商主商品';
    }

    public function query()
    {
        return Goods::select(["id", "name", "sku", "price", "status", "sort", "content1"]);
    }

    public function headings(): array
    {
        return [
            '編號', '名稱', 'sku', '價格', '狀態(Y/N)', '排序', '商品描述',
        ];
    }
}
