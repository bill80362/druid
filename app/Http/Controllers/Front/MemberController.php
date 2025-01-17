<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
    public function member($id)
    {
        return view("front/member",[
            "member" => Member::find($id),
        ]);
    }
}
