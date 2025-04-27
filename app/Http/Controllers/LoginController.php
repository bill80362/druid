<?php

namespace App\Http\Controllers;



use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login()
    {
        return view('login/login');
    }
    public function loginAction(Request $request)
    {
        //
        Log::info($request->getClientIp());
        //
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        //檢查到期時間
        $credentials[] = function (Builder $query){
            $query->where("expired_at", ">=", Carbon::now());
        };

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => '登入帳密錯誤，或請確認到期時間是否過期',
        ])->onlyInput('email');
    }
}
