<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\SpecOption;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SpecOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('規格選項管理_讀取')) {
            abort(403);
        }
        //
        return view('spec_option.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('規格選項管理_新增')) {
            abort(403);
        }
        //
        $SpecOption = new SpecOption([]);
        //
        return view('spec_option.create', [
            "item" => $SpecOption,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('規格選項管理_新增')) {
            abort(403);
        }
        //
        $SpecOption = new SpecOption($request->all());
        $SpecOption->save();
        //
        return redirect()->route('spec_options.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecOption $SpecOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecOption $SpecOption)
    {
        if (! Gate::allows('規格選項管理_修改')) {
            abort(403);
        }
        //
        return view('spec_option.edit', [
            "item" => $SpecOption,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecOption $SpecOption)
    {
        if (! Gate::allows('規格選項管理_修改')) {
            abort(403);
        }
        $SpecOption->fill($request->only(["name","content"]));
        $SpecOption->save();
        //
        return redirect()->route('spec_options.edit', ["spec_option" => $SpecOption])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecOption $SpecOption)
    {
        if (! Gate::allows('規格選項管理_刪除')) {
            abort(403);
        }
        $SpecOption->delete();
        return redirect()->route('spec_options.index')->with("success",["刪除成功"]);
    }
}
