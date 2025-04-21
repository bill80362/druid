<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Discount;
use App\Models\GoodsDetail;
use App\Models\Level;
use App\Models\Line;
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
    public function login($slug)
    {
        return view('line_liff/login',[
            "line" => Line::where("slug",$slug)->first(),
        ]);
    }
    public function profile($slug)
    {
        //
        $id = Line::where("slug",$slug)->firstOrFail()->user_id;
        //
        $member = Member::with(["level"])->where("user_id",$id)->where("line_id",request()->get("userId"))->first();
        //
        if($member){
            //
            $coupons = Coupon::where("status", "Y")
                ->where("user_id",$id)
                ->where("discount_start", "<=", date("Y-m-d H:i:s"))
                ->where("discount_end", ">=", date("Y-m-d H:i:s"))
                ->get();
            //
            $couponUsed = [];
            if($coupons?->count()){
                $couponUsed = Order::where("status","<>","cancel")
                    ->where("user_id",$id)
                    ->where("member_id",$member->id)
                    ->whereIn("coupon_id",$coupons->pluck("id")->toArray())
                    ->get()->pluck("coupon_id")->filter()->toArray();
                if($couponUsed){
                    $coupons = $coupons->filter(fn($i)=>!in_array($i->id,$couponUsed));
                }
            }
            //
            return view('line_liff/profile', [
                "member" => $member,
                "coupons" => $coupons,
                "couponUsed" => $couponUsed,
            ]);
        }else{
            return view('line_liff/register',[
                "user_id" => $id,
            ]);
        }

    }
    public function register($slug)
    {
        //
        $id = Line::where("slug",$slug)->firstOrFail()->user_id;
        //
        $memberExist = Member::where("phone",request()->get("phone"))->where("user_id",$id)->first();
        if($memberExist){
            return redirect()->back()->withErrors([request()->get("phone")."手機註冊了，請告知店家協助綁定帳號即可"]);
        }
        //
        $member = new Member();
        $member->status = "n";
        $member->user_id = $id;
        $member->phone = request()->get("phone");
        $member->name = request()->get("name");
        $member->line_id = request()->get("line_id");
        $member->birthday = request()->get("birthday");
        $member->save();
        //
        return redirect()->to("/line_liff/profile/{$id}?userId=".$member->line_id);
    }


}
