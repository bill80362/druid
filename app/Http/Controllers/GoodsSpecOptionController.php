<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\GoodsSpecOption;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class GoodsSpecOptionController extends Controller
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
        return view('goods_spec_option.index');
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
        $GoodsSpecOption = new GoodsSpecOption([]);
        //
        return view('goods_spec_option.create', [
            "item" => $GoodsSpecOption,
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
        $GoodsSpecOption = new GoodsSpecOption($request->all());
        $GoodsSpecOption->save();
        //
        return redirect()->route('goods_spec_options.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GoodsSpecOption $GoodsSpecOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GoodsSpecOption $GoodsSpecOption)
    {
        if (! Gate::allows('商品明細管理_修改')) {
            abort(403);
        }
        //
        return view('goods_spec_option.edit', [
            "item" => $GoodsSpecOption,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GoodsSpecOption $GoodsSpecOption)
    {
        if (! Gate::allows('商品明細管理_修改')) {
            abort(403);
        }
        $GoodsSpecOption->fill($request->only(["name","content"]));
        $GoodsSpecOption->save();
        //
        return redirect()->route('goods_spec_options.edit', ["goods_spec_option" => $GoodsSpecOption])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GoodsSpecOption $GoodsSpecOption)
    {
        if (! Gate::allows('商品明細管理_刪除')) {
            abort(403);
        }
        $GoodsSpecOption->delete();
        return redirect()->route('goods_spec_options.index')->with("success",["刪除成功"]);
    }
}
