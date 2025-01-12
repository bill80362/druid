<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\MetaMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Spatie\QueryBuilder\QueryBuilder;

class MetaMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('Meta對話記錄管理_讀取')) {
            abort(403);
        }
        //
        return view('meta_messages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('Meta對話記錄管理_新增')) {
            abort(403);
        }
        //
        $MetaMessage = new MetaMessage([]);
        //
        return view('meta_messages.create', [
            "item" => $MetaMessage,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('Meta對話記錄管理_新增')) {
            abort(403);
        }
        //
        $MetaMessage = new MetaMessage($request->all());
        $MetaMessage->save();
        //
        return redirect()->route('meta_messages.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaMessage $MetaMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaMessage $MetaMessage)
    {
        if (! Gate::allows('Meta對話記錄管理_修改')) {
            abort(403);
        }
        //
        return view('meta_messages.edit', [
            "item" => $MetaMessage,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MetaMessage $MetaMessage)
    {
        if (! Gate::allows('Meta對話記錄管理_修改')) {
            abort(403);
        }
        $MetaMessage->fill($request->only(["name","content"]));
        $MetaMessage->save();
        //
        return redirect()->route('meta_messages.edit', ["meta_message" => $MetaMessage])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaMessage $MetaMessage)
    {
        if (! Gate::allows('Meta對話記錄管理_刪除')) {
            abort(403);
        }
        $MetaMessage->delete();
        return redirect()->route('meta_messages.index')->with("success",["刪除成功"]);
    }
}
