<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Order;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Spatie\QueryBuilder\QueryBuilder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('訂單管理_讀取')) {
            abort(403);
        }
        //
        return view('order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('訂單管理_新增')) {
            abort(403);
        }
        //
        $Order = new Order([]);
        //
        return view('order.create', [
            "item" => $Order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('訂單管理_新增')) {
            abort(403);
        }
        //
        $Order = new Order($request->all());
        $Order->save();
        //
        return redirect()->route('orders.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $Order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $Order)
    {
        if (! Gate::allows('訂單管理_修改')) {
            abort(403);
        }
        //
        return view('order.edit', [
            "item" => $Order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $Order)
    {
        if (! Gate::allows('訂單管理_修改')) {
            abort(403);
        }
        $Order->fill($request->only(["name","content"]));
        $Order->save();
        //
        return redirect()->route('orders.edit', ["order" => $Order])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $Order)
    {
        if (! Gate::allows('訂單管理_刪除')) {
            abort(403);
        }
        $Order->delete();
        return redirect()->route('orders.index')->with("success",["刪除成功"]);
    }
}
