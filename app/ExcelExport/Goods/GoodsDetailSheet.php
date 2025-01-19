<?php

namespace App\ExcelExport\Goods;

use App\Models\GoodsDetail;
use Generator;
use Maatwebsite\Excel\Concerns\FromGenerator;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class GoodsDetailSheet implements FromGenerator, WithTitle, WithHeadings
{
    public function title(): string
    {
        return '商品明細';
    }

    public function generator(): Generator
    {
        $goodsDetails = GoodsDetail::with("specOptions")->get();
        foreach ($goodsDetails as $item) {
            yield [
                $item->id,
                $item->goods_id,
                $item->name,
                $item->sku,
                $item->price,
                $item->status,
                $item->sort,
                $item->specOptions?->pluck("id")?->implode(","),
            ];
        }
        yield [];
    }

    public function headings(): array
    {
        return [
            '編號', '主商品編號', '名稱', 'sku', '價格', '狀態', '排序', '規格選項編號(逗號分隔)',
        ];
    }
}
