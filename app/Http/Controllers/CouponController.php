<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Coupon;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('優惠券管理_讀取')) {
            abort(403);
        }
        //
        return view('coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('優惠券管理_新增')) {
            abort(403);
        }
        //
        $Coupon = new Coupon([]);
        //
        return view('coupon.create', [
            "item" => $Coupon,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('優惠券管理_新增')) {
            abort(403);
        }
        //
        $Coupon = new Coupon($request->all());
        $Coupon->save();
        //
        return redirect()->route('coupons.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $Coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $Coupon)
    {
        if (! Gate::allows('優惠券管理_修改')) {
            abort(403);
        }
        //
        return view('coupon.edit', [
            "item" => $Coupon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $Coupon)
    {
        if (! Gate::allows('優惠券管理_修改')) {
            abort(403);
        }
        $Coupon->fill($request->only(["name","content"]));
        $Coupon->save();
        //
        return redirect()->route('coupons.edit', ["coupon" => $Coupon])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $Coupon)
    {
        if (! Gate::allows('優惠券管理_刪除')) {
            abort(403);
        }
        $Coupon->delete();
        return redirect()->route('coupons.index')->with("success",["刪除成功"]);
    }
}
