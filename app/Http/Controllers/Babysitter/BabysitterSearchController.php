<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\Babysitter\BabysitterSearchLog;
use App\Models\City;

class BabysitterSearchController extends Controller
{
    public function searchRedirect()
    {
        return view('babysitter/search_redirect');
    }
    public function search()
    {
        //紀錄
        $log = BabysitterSearchLog::where("line_user_id",request()->get("userId"))->firstOrNew();
        if(request()->get("filter_city")){
            $log->line_user_id = request()->get("userId");
            $log->city_id = request()->get("filter_city");
            $log->region_id = request()->get("filter_region");
            $log->save();
        }
        //
        $filter_city = request()->get("filter_city",$log->city_id);
        $filter_region = request()->get("filter_region",$log->region_id);
        //
        $query = Babysitter::whereIn("status",["Y","I"])->with(["services","addressCity","addressRegion"]);
        if($filter_city){
            $query->where("city",$filter_city);
        }
        if($filter_region){
            $query->where("region",$filter_region);
        }
        $paginator = $query->orderBy('sign_at','desc')->orderBy('status','desc')->paginate()->withQueryString();
        //
        $cities = City::select(["id","name"])->with(["regions"])->get();
        //
        return view('babysitter/search_search',[
            "paginator" => $paginator,
            "cities" => $cities,
            "filter_city" => $filter_city,
            "filter_region" => $filter_region,
        ]);
    }
    public function searchSubmit()
    {

    }
}
