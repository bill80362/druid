<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;

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
        $userId = request()->get("userId");
        $name = request()->get("name");
        //

        //
        return view('babysitter/login_login');
    }
    //POST babysitter/login/login
    public function loginSubmit()
    {

    }
}
