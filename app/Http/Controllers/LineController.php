<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Line;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('LINE帳號管理_讀取')) {
            abort(403);
        }
        //
        return view('line.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('LINE帳號管理_新增')) {
            abort(403);
        }
        //
        $Line = new Line([]);
        //
        return view('line.create', [
            "item" => $Line,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('LINE帳號管理_新增')) {
            abort(403);
        }
        //
        $Line = new Line($request->all());
        $Line->save();
        //
        return redirect()->route('lines.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Line $Line)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Line $Line)
    {
        if (! Gate::allows('LINE帳號管理_修改')) {
            abort(403);
        }
        //
        return view('line.edit', [
            "item" => $Line,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Line $Line)
    {
        if (! Gate::allows('LINE帳號管理_修改')) {
            abort(403);
        }
        $Line->fill($request->only(["name","content"]));
        $Line->save();
        //
        return redirect()->route('lines.edit', ["line" => $Line])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Line $Line)
    {
        if (! Gate::allows('LINE帳號管理_刪除')) {
            abort(403);
        }
        $Line->delete();
        return redirect()->route('lines.index')->with("success",["刪除成功"]);
    }
}
