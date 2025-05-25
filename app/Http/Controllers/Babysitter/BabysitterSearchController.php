<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\City;

class BabysitterSearchController extends Controller
{
    public function searchRedirect()
    {
        return view('babysitter/search_redirect');
    }
    public function search()
    {
        //
        $query = Babysitter::whereIn("status",["Y","I"])->with(["services","addressCity","addressRegion"]);
        if(request()->get("filter_city")){
            $query->where("city",request()->get("filter_city"));
        }
        if(request()->get("filter_region")){
            $query->where("region",request()->get("filter_region"));
        }
        $paginator = $query->paginate()->withQueryString();
        //
        $cities = City::select(["id","name"])->with(["regions"])->get();
        //
        return view('babysitter/search_search',[
            "paginator" => $paginator,
            "cities" => $cities,
        ]);
    }
    public function searchSubmit()
    {

    }
}
