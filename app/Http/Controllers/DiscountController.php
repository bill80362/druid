<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('折扣管理_讀取')) {
            abort(403);
        }
        //
        return view('discount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('折扣管理_新增')) {
            abort(403);
        }
        //
        $Discount = new Discount([]);
        //
        return view('discount.create', [
            "item" => $Discount,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('折扣管理_新增')) {
            abort(403);
        }
        //
        $Discount = new Discount($request->all());
        $Discount->save();
        //
        return redirect()->route('discounts.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $Discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $Discount)
    {
        if (! Gate::allows('折扣管理_修改')) {
            abort(403);
        }
        //
        return view('discount.edit', [
            "item" => $Discount,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $Discount)
    {
        if (! Gate::allows('折扣管理_修改')) {
            abort(403);
        }
        $Discount->fill($request->only(["name","content"]));
        $Discount->save();
        //
        return redirect()->route('discounts.edit', ["discount" => $Discount])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $Discount)
    {
        if (! Gate::allows('折扣管理_刪除')) {
            abort(403);
        }
        $Discount->delete();
        return redirect()->route('discounts.index')->with("success",["刪除成功"]);
    }
}
