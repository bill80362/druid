<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\City;
use Illuminate\Http\Request;
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
    public function loginSubmit(Request $request)
    {
        //
        $request->validate([
            "name" => ["required","string","max:5"],
            "city" => ["required",'numeric','min:1'],
            "region" => ["required",'numeric','min:1'],
            "address" => ["nullable","string","max:50"],
            "cellphone" => ["nullable","string","max:10"],
            "info" => ["nullable","string","max:200"],
            "url" => ["nullable","string","max:150"],
            "certification" => ["nullable","string","max:50"],
        ],[
            "city.*" => "縣市為必填",
            "region.*" => "區域為必填",
        ],[
            "name" => "名稱",
            "city" => "縣市",
            "region" => "區域",
            "address" => "說明",
            "cellphone" => "手機",
            "info" => "說明",
            "url" => "網址連結",
            "certification" => "認證碼",
        ]);
        //
        $item = Babysitter::where("line_id",request('userId'))->firstOrNew();
        $item->status = request('status');
        $item->line_id = request('userId');
        $item->name = request('name');
        $item->cellphone = request('cellphone');
        $item->city = request('city');
        $item->region = request('region');
        $item->address = request('address');
        $item->info = request('info');
        $item->url = request('url');
        $item->certification = request('certification');
        $item->save();
        //
        $item->services()->sync(request("services")??null);
        //
        return redirect()->route("babysitter.login",["userId"=>$item->line_id])
            ->with("success", ["送出成功"]);
    }
}
