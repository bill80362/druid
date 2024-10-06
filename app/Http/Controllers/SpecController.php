<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Spec;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class SpecController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('規格群組管理_讀取')) {
            abort(403);
        }
        //
        return view('spec.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('規格群組管理_新增')) {
            abort(403);
        }
        //
        $Spec = new Spec([]);
        //
        return view('spec.create', [
            "item" => $Spec,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('規格群組管理_新增')) {
            abort(403);
        }
        //
        $Spec = new Spec($request->all());
        $Spec->save();
        //
        return redirect()->route('specs.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Spec $Spec)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spec $Spec)
    {
        if (! Gate::allows('規格群組管理_修改')) {
            abort(403);
        }
        //
        return view('spec.edit', [
            "item" => $Spec,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spec $Spec)
    {
        if (! Gate::allows('規格群組管理_修改')) {
            abort(403);
        }
        $Spec->fill($request->only(["name","content"]));
        $Spec->save();
        //
        return redirect()->route('specs.edit', ["spec" => $Spec])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spec $Spec)
    {
        if (! Gate::allows('規格群組管理_刪除')) {
            abort(403);
        }
        $Spec->delete();
        return redirect()->route('specs.index')->with("success",["刪除成功"]);
    }
}
