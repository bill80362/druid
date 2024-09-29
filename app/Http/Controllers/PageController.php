<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('頁面管理_讀取')) {
            abort(403);
        }
        //
        return view('page.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('頁面管理_新增')) {
            abort(403);
        }
        //
        $Page = new Page([]);
        //
        return view('page.create', [
            "item" => $Page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('頁面管理_新增')) {
            abort(403);
        }
        //
        $Page = new Page($request->all());
        $Page->save();
        //
        return redirect()->route('pages.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $Page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $Page)
    {
        if (! Gate::allows('頁面管理_修改')) {
            abort(403);
        }
        //
        return view('page.edit', [
            "item" => $Page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $Page)
    {
        if (! Gate::allows('頁面管理_修改')) {
            abort(403);
        }
        $Page->fill($request->only(["name","content"]));
        $Page->save();
        //
        return redirect()->route('pages.edit', ["user" => $Page])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $Page)
    {
        if (! Gate::allows('頁面管理_刪除')) {
            abort(403);
        }
        $Page->delete();
        return redirect()->route('pages.index')->with("success",["刪除成功"]);
    }
}
