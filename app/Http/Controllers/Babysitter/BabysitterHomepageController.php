<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\Babysitter\BabysitterLike;
use App\Models\City;

class BabysitterHomepageController extends Controller
{
    public function index()
    {
        $filter_city = request()->get("filter_city");
        $filter_region = request()->get("filter_region");
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
            "filter_show_like" => "",
            "likeIds" => [],
            "userId" => "",
            "city" => $filter_city?\App\Models\City::find($filter_city):null,
            "region" => $filter_region?\App\Models\Region::find($filter_region):null,
        ]);
    }

}
