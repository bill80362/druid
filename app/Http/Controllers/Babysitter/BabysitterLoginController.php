<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\City;
use function Laravel\Prompts\select;

class BabysitterLoginController extends Controller
{
    //babysitter/login/redirect
    public function loginRedirect()
    {
        return view('babysitter/login_redirect');
    }
    //babysitter/login/login
    public function login()
    {
        //
        $userId = request("userId");
        $name = request("name");
        //
        $item = Babysitter::with(["services"])->where("line_id",$userId)->firstOrNew();
        $item->line_id = $userId;
        if(!$item->name){
            $item->name = $name;
        }
        //
        $cities = City::select(["id","name"])->with(["regions"])->get();
        //
        return view('babysitter/login_login',[
            "item" => $item,
            "cities" => $cities,
        ]);
    }
    //POST babysitter/login/login
    public function loginSubmit()
    {
        //
        $item = Babysitter::where("line_id",request('userId'))->firstOrNew();
        $item->status = request('status');
        $item->line_id = request('userId');
        $item->name = request('name');
        $item->cellphone = request('cellphone');
        $item->city = request('city');
        $item->region = request('region');
        $item->address = request('address');
        $item->save();
        //
        $item->services()->sync(request("services")??null);
        //
        return redirect()->route("babysitter.login",["userId"=>$item->line_id])
            ->with("success", ["送出成功"]);
    }
}
