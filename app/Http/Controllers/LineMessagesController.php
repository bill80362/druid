<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\LineMessages;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class LineMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('LINE對話記錄管理_讀取')) {
            abort(403);
        }
        //
        return view('line_messages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('LINE對話記錄管理_新增')) {
            abort(403);
        }
        //
        $LineMessages = new LineMessages([]);
        //
        return view('line_messages.create', [
            "item" => $LineMessages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('LINE對話記錄管理_新增')) {
            abort(403);
        }
        //
        $LineMessages = new LineMessages($request->all());
        $LineMessages->save();
        //
        return redirect()->route('line_messages.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LineMessages $LineMessages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LineMessages $LineMessages)
    {
        if (! Gate::allows('LINE對話記錄管理_修改')) {
            abort(403);
        }
        //
        return view('line_messages.edit', [
            "item" => $LineMessages,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LineMessages $LineMessages)
    {
        if (! Gate::allows('LINE對話記錄管理_修改')) {
            abort(403);
        }
        $LineMessages->fill($request->only(["name","content"]));
        $LineMessages->save();
        //
        return redirect()->route('line_messages.edit', ["line_message" => $LineMessages])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LineMessages $LineMessages)
    {
        if (! Gate::allows('LINE對話記錄管理_刪除')) {
            abort(403);
        }
        $LineMessages->delete();
        return redirect()->route('line_messages.index')->with("success",["刪除成功"]);
    }
}
