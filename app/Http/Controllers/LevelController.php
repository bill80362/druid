<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Level;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('等級管理_讀取')) {
            abort(403);
        }
        //
        return view('level.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('等級管理_新增')) {
            abort(403);
        }
        //
        $Level = new Level([]);
        //
        return view('level.create', [
            "item" => $Level,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('等級管理_新增')) {
            abort(403);
        }
        //
        $Level = new Level($request->all());
        $Level->save();
        //
        return redirect()->route('levels.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $Level)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $Level)
    {
        if (! Gate::allows('等級管理_修改')) {
            abort(403);
        }
        //
        return view('level.edit', [
            "item" => $Level,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $Level)
    {
        if (! Gate::allows('等級管理_修改')) {
            abort(403);
        }
        $Level->fill($request->only(["name","content"]));
        $Level->save();
        //
        return redirect()->route('levels.edit', ["level" => $Level])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $Level)
    {
        if (! Gate::allows('等級管理_刪除')) {
            abort(403);
        }
        $Level->delete();
        return redirect()->route('levels.index')->with("success",["刪除成功"]);
    }
}
