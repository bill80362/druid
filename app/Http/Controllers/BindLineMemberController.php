<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class BindLineMemberController extends Controller
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
        return view('bind_line_member.index');
    }
    public function update(Request $request, Member $Member)
    {
        if (! Gate::allows('會員管理_修改')) {
            abort(403);
        }
        //
        $checkMember = Member::where("line_id",$request->get("line_id"))->first();
        if($checkMember){
            return redirect()->back()->with("success",["綁定失敗，此Line ID已經其他會員綁定".$checkMember->name.",".$checkMember->phone]);
        }
        //
        $Member->line_id = $request->get("line_id");
        $Member->save();
        //
        return redirect()->route('members.edit', ["member" => $Member])->with("success",["儲存成功"]);
    }
}
