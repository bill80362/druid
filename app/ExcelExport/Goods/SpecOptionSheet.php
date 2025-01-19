<?php

namespace App\ExcelExport\Goods;

use App\Models\Goods;
use App\Models\Spec;
use App\Models\SpecOption;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SpecOptionSheet implements FromQuery, WithTitle , WithHeadings
{
    public function title(): string
    {
        return '規格選項';
    }
    public function query()
    {
        return SpecOption::select(["id","name","sku","content","status","sort","spec_id"]);
    }
    public function headings(): array
    {
        return [
            '編號', '名稱', 'sku','描述', '狀態(Y/N)', '排序', '規格群組編號',
        ];
    }
}
