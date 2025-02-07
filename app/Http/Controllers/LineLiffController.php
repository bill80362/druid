<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\GoodsDetail;
use App\Models\Level;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPayment;
use App\Models\Payment;
use App\Models\Point;
use App\Models\Setting;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartGoods;
use App\Models\ShoppingPayment;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class LineLiffController extends Controller
{
    public function profile()
    {
        //
        $member = Member::with(["level"])->where("line_id",request()->get("userId"))->first();
        if($member){
            return view('line_liff/profile', [
                "member" => $member,
            ]);
        }else{
            return view('line_liff/register');
        }

    }
    public function register()
    {
        //
        $memberExist = Member::where("phone",request()->get("phone"))->first();
        if($memberExist){
            return redirect()->back()->withErrors([request()->get("phone")."手機註冊了，請告知店家協助綁定帳號即可"]);
        }
        //
        $member = new Member();
        $member->status = "n";
        $member->phone = request()->get("phone");
        $member->name = request()->get("name");
        $member->line_id = request()->get("line_id");
        $member->birthday = request()->get("birthday");
        $member->save();
        //
        return redirect()->to("/line_liff/profile?userId=".$member->line_id);
    }


}
