<?php

namespace App\ExcelExport\Goods;

use App\Models\Goods;
use App\Models\Spec;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SpecSheet implements FromQuery, WithTitle , WithHeadings
{
    public function title(): string
    {
        return '規格群組';
    }
    public function query()
    {
        return Spec::select(["id","name","content"]);
    }
    public function headings(): array
    {
        return [
            '編號', '名稱', '描述',
        ];
    }
}
