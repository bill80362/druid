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

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('checkout/checkout');
    }
}
