<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Reply;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('自動回應管理_讀取')) {
            abort(403);
        }
        //
        return view('reply.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('自動回應管理_新增')) {
            abort(403);
        }
        //
        $Reply = new Reply([]);
        //
        return view('reply.create', [
            "item" => $Reply,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('自動回應管理_新增')) {
            abort(403);
        }
        //
        $Reply = new Reply($request->all());
        $Reply->save();
        //
        return redirect()->route('replies.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $Reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $Reply)
    {
        if (! Gate::allows('自動回應管理_修改')) {
            abort(403);
        }
        //
        return view('reply.edit', [
            "item" => $Reply,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $Reply)
    {
        if (! Gate::allows('自動回應管理_修改')) {
            abort(403);
        }
        $Reply->fill($request->only(["name","content"]));
        $Reply->save();
        //
        return redirect()->route('replies.edit', ["reply" => $Reply])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $Reply)
    {
        if (! Gate::allows('自動回應管理_刪除')) {
            abort(403);
        }
        $Reply->delete();
        return redirect()->route('replies.index')->with("success",["刪除成功"]);
    }
}
