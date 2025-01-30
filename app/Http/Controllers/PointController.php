<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Point;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('點數管理_讀取')) {
            abort(403);
        }
        //
        return view('point.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('點數管理_新增')) {
            abort(403);
        }
        //
        $Point = new Point([]);
        //
        return view('point.create', [
            "item" => $Point,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('點數管理_新增')) {
            abort(403);
        }
        //
        $Point = new Point($request->all());
        $Point->save();
        //
        return redirect()->route('points.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Point $Point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Point $Point)
    {
        if (! Gate::allows('點數管理_修改')) {
            abort(403);
        }
        //
        return view('point.edit', [
            "item" => $Point,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Point $Point)
    {
        if (! Gate::allows('點數管理_修改')) {
            abort(403);
        }
        $Point->fill($request->only(["name","content"]));
        $Point->save();
        //
        return redirect()->route('points.edit', ["point" => $Point])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Point $Point)
    {
        if (! Gate::allows('點數管理_刪除')) {
            abort(403);
        }
        $Point->delete();
        return redirect()->route('points.index')->with("success",["刪除成功"]);
    }
}
