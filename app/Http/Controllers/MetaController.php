<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Meta;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Spatie\QueryBuilder\QueryBuilder;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('Meta串接管理_讀取')) {
            abort(403);
        }
        //
        return view('meta.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('Meta串接管理_新增')) {
            abort(403);
        }
        //
        $Meta = new Meta([]);
        //
        return view('meta.create', [
            "item" => $Meta,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('Meta串接管理_新增')) {
            abort(403);
        }
        //
        $Meta = new Meta($request->all());
        $Meta->save();
        //
        return redirect()->route('metas.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meta $Meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meta $Meta)
    {
        if (! Gate::allows('Meta串接管理_修改')) {
            abort(403);
        }
        //
        return view('meta.edit', [
            "item" => $Meta,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meta $Meta)
    {
        if (! Gate::allows('Meta串接管理_修改')) {
            abort(403);
        }
        $Meta->fill($request->only(["name","content"]));
        $Meta->save();
        //
        return redirect()->route('metas.edit', ["meta" => $Meta])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meta $Meta)
    {
        if (! Gate::allows('Meta串接管理_刪除')) {
            abort(403);
        }
        $Meta->delete();
        return redirect()->route('metas.index')->with("success",["刪除成功"]);
    }
}
