<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;

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
        return view('babysitter/login_login',[
            "item" => $item,
        ]);
    }
    //POST babysitter/login/login
    public function loginSubmit()
    {
        //
        $item = Babysitter::where("line_id",request('userId'))->firstOrNew();
        $item->line_id = request('userId');
        $item->name = request('name');
        $item->cellphone = request('cellphone');
        $item->address = request('address');
        $item->save();
        //
        $item->services()->sync(request("services")??null);
        //
        return redirect()->route("babysitter.login",["userId"=>$item->line_id])
            ->with("success", ["送出成功"]);
    }
}
