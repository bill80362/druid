<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Member;
use App\Models\Point;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('會員管理_讀取')) {
            abort(403);
        }
        //
        return view('member.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('會員管理_新增')) {
            abort(403);
        }
        //
        $Member = new Member([]);
        //
        return view('member.create', [
            "item" => $Member,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('會員管理_新增')) {
            abort(403);
        }
        //
        $Member = new Member($request->all());
        $Member->save();
        //
        return redirect()->route('members.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $Member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $Member)
    {
        if (! Gate::allows('會員管理_修改')) {
            abort(403);
        }
        //
        return view('member.edit', [
            "item" => $Member,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $Member)
    {
        if (! Gate::allows('會員管理_修改')) {
            abort(403);
        }
        $Member->fill($request->only(["name","content"]));
        $Member->save();
        //
        return redirect()->route('members.edit', ["member" => $Member])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $Member)
    {
        if (! Gate::allows('會員管理_刪除')) {
            abort(403);
        }
        $Member->delete();
        return redirect()->route('members.index')->with("success",["刪除成功"]);
    }

    public function pointAdd($id)
    {
        $member = Member::find($id);
        $point = new Point();
        $point->point = request()->get("point");
        $point->name = "手動補點";
        $member->points()->save($point);
        return redirect()->route('members.edit', ["member" => $member])->with("success",["補點成功"]);
    }
    public function pointMinus($id)
    {
        $member = Member::withSum('points','point')->find($id);
        //
        if($member->points_sum_point < (int)request()->get("point")){
            return redirect()->route('members.edit', ["member" => $member])->with("success",["扣點失敗，餘額不足(".$member->points_sum_point.")"]);
        }
        //
        $point = new Point();
        $point->point = request()->get("point")*-1;
        $point->name = "手動扣點";
        $member->points()->save($point);
        return redirect()->route('members.edit', ["member" => $member])->with("success",["扣點成功"]);
    }
}
