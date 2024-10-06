<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Goods;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('主商品管理_讀取')) {
            abort(403);
        }
        //
        return view('goods.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('主商品管理_新增')) {
            abort(403);
        }
        //
        $Goods = new Goods([]);
        //
        return view('goods.create', [
            "item" => $Goods,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('主商品管理_新增')) {
            abort(403);
        }
        //
        $Goods = new Goods($request->all());
        $Goods->save();
        //
        return redirect()->route('goods.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Goods $Goods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goods $Goods)
    {
        if (! Gate::allows('主商品管理_修改')) {
            abort(403);
        }
        //
        return view('goods.edit', [
            "item" => $Goods,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goods $Goods)
    {
        if (! Gate::allows('主商品管理_修改')) {
            abort(403);
        }
        $Goods->fill($request->only(["name","content"]));
        $Goods->save();
        //
        return redirect()->route('goods.edit', ["goods" => $Goods])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goods $Goods)
    {
        if (! Gate::allows('主商品管理_刪除')) {
            abort(403);
        }
        $Goods->delete();
        return redirect()->route('goods.index')->with("success",["刪除成功"]);
    }
}
