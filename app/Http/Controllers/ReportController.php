<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function day()
    {
        //
        $dayReports = Order::where("status", "finish")
            ->selectRaw("DATE(created_at) as created_at,SUM(total) as sum_total,COUNT(total) as count_total")
            ->groupByRaw("DATE(created_at)")
            ->get()
            ->map(function ($item) {
                return [
                    "title" => "$ ".number_format($item->sum_total) . "(" . $item->count_total . ")",
                    "start" => $item->created_at->format("Y-m-d"),
                    "description" => "ABC",
                ];
            })->all();
//        dd($dayReports);
        //
        return view('report.day',[
            "dayReports" => $dayReports,
        ]);
    }
}
