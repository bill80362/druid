<?php

namespace App\Http\Controllers;

use App\ExcelExport\Goods\GoodsExport;
use App\ExcelImport\Goods\GoodsImport;
use App\Models\Goods;
use App\Models\GoodsDetail;
use App\Models\GoodsDetailSpecOption;
use App\Models\Spec;
use App\Models\SpecOption;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function export()
    {
        return (new GoodsExport())->download('電商主商品'.date("YmdHis").'.xlsx');
    }
    public function import()
    {
        return view('import/goods');
    }
    public function importAction()
    {
//        dd(request()->file('file'));
        Excel::import(new GoodsImport(), request()->file('file'));

        return redirect()->route("excel.import")->with("success", ["匯入成功"]);
    }


}
