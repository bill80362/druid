<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\GoodsDetail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Spatie\QueryBuilder\QueryBuilder;

class GoodsDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('商品明細管理_讀取')) {
            abort(403);
        }
        //
        return view('goods_detail.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('商品明細管理_新增')) {
            abort(403);
        }
        //
        $GoodsDetail = new GoodsDetail([]);
        //
        return view('goods_detail.create', [
            "item" => $GoodsDetail,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('商品明細管理_新增')) {
            abort(403);
        }
        //
        $GoodsDetail = new GoodsDetail($request->all());
        $GoodsDetail->save();
        //
        return redirect()->route('goods_details.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GoodsDetail $GoodsDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoodsDetail $GoodsDetail)
    {
        if (! Gate::allows('商品明細管理_修改')) {
            abort(403);
        }
        //
        return view('goods_detail.edit', [
            "item" => $GoodsDetail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GoodsDetail $GoodsDetail)
    {
        if (! Gate::allows('商品明細管理_修改')) {
            abort(403);
        }
        $GoodsDetail->fill($request->only(["name","content"]));
        $GoodsDetail->save();
        //
        return redirect()->route('goods_details.edit', ["goods_detail" => $GoodsDetail])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoodsDetail $GoodsDetail)
    {
        if (! Gate::allows('商品明細管理_刪除')) {
            abort(403);
        }
        $GoodsDetail->delete();
        return redirect()->route('goods_details.index')->with("success",["刪除成功"]);
    }
}
