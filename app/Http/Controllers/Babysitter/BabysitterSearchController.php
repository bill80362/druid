<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\Babysitter\BabysitterLike;
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
            $log->show_like = request()->get("filter_show_like");
            $log->save();
        }
        //
        $filter_city = request()->get("filter_city",$log->city_id);
        $filter_region = request()->get("filter_region",$log->region_id);
        $filter_show_like = request()->get("filter_show_like",$log->show_like);
        //
        $query = Babysitter::whereIn("status",["Y","I"])->with(["services","addressCity","addressRegion"]);
        if($filter_city){
            $query->where("city",$filter_city);
        }
        if($filter_region){
            $query->where("region",$filter_region);
        }
        if($filter_show_like){
            $query->whereHas("likes", fn($q) => $q->where("line_user_id", request()->get("userId")));
        }
        $paginator = $query->orderBy('sign_at','desc')->orderBy('status','desc')->paginate()->withQueryString();
        //
        $cities = City::select(["id","name"])->with(["regions"])->get();
        //
        $likeIds = BabysitterLike::where("line_user_id",request()->get("userId"))->get()->pluck("babysitter_id")->toArray();
        //
        return view('babysitter/search_search',[
            "paginator" => $paginator,
            "cities" => $cities,
            "filter_city" => $filter_city,
            "filter_region" => $filter_region,
            "filter_show_like" => $filter_show_like,
            "likeIds" => $likeIds,
        ]);
    }
    public function like()
    {
        $line_user_id = request()->get("line_user_id");
        $babysitter_id = request()->get("babysitter_id");
        $like_type = request()->get("like_type");
        if($like_type==1){
            $item = BabysitterLike::where("line_user_id",$line_user_id)->where("babysitter_id",$babysitter_id)->firstOrNew();
            $item->line_user_id = $line_user_id;
            $item->babysitter_id = $babysitter_id;
            $item->save();
        }elseif($like_type==2){
            BabysitterLike::where("line_user_id",$line_user_id)->where("babysitter_id",$babysitter_id)->delete();
        }
        return response()->json(["success"=>true]);
    }
    public function searchSubmit()
    {

    }
}
