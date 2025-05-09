<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (! Gate::allows('系統設定管理_修改')) {
            abort(403);
        }
        //
        return view('setting.edit', [
            "item" => Setting::user()->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('系統設定管理_修改')) {
            abort(403);
        }
        $setting = Setting::user()->firstOrNew();
        $setting->user_id = auth()->user()->id;
        $setting->name = "系統設定";
        $setting->content = [
            "point_to_money" => $request->get("point_to_money"),
            "reply_without_register" => $request->get("reply_without_register"),
        ];
        $setting->save();
        //
        return redirect()->route('settings.edit', ["setting" => $id])->with("success",["儲存成功"]);
    }

}
