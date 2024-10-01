<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\PageTag;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class PageTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('頁面標籤管理_讀取')) {
            abort(403);
        }
        //
        return view('page_tag.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('頁面標籤管理_新增')) {
            abort(403);
        }
        //
        $PageTag = new PageTag([]);
        //
        return view('page_tag.create', [
            "item" => $PageTag,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('頁面標籤管理_新增')) {
            abort(403);
        }
        //
        $PageTag = new PageTag($request->all());
        $PageTag->save();
        //
        return redirect()->route('page_tags.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageTag $PageTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageTag $PageTag)
    {
        if (! Gate::allows('頁面標籤管理_修改')) {
            abort(403);
        }
        //
        return view('page_tag.edit', [
            "item" => $PageTag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageTag $PageTag)
    {
        if (! Gate::allows('頁面標籤管理_修改')) {
            abort(403);
        }
        $PageTag->fill($request->only(["name","content"]));
        $PageTag->save();
        //
        return redirect()->route('page_tags.edit', ["page_tag" => $PageTag])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageTag $PageTag)
    {
        if (! Gate::allows('頁面標籤管理_刪除')) {
            abort(403);
        }
        $PageTag->delete();
        return redirect()->route('page_tags.index')->with("success",["刪除成功"]);
    }
}
