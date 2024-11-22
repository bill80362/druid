<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\LegalAttestLetter;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class LegalAttestLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('存證信函管理_讀取')) {
            abort(403);
        }
        //
        return view('legal_attest_letter.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('存證信函管理_新增')) {
            abort(403);
        }
        //
        $LegalAttestLetter = new LegalAttestLetter([]);
        //
        return view('legal_attest_letter.create', [
            "item" => $LegalAttestLetter,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('存證信函管理_新增')) {
            abort(403);
        }
        //
        $LegalAttestLetter = new LegalAttestLetter($request->all());
        $LegalAttestLetter->save();
        //
        return redirect()->route('legal_attest_letters.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalAttestLetter $LegalAttestLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalAttestLetter $LegalAttestLetter)
    {
        if (! Gate::allows('存證信函管理_修改')) {
            abort(403);
        }
        //
        return view('legal_attest_letter.edit', [
            "item" => $LegalAttestLetter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LegalAttestLetter $LegalAttestLetter)
    {
        if (! Gate::allows('存證信函管理_修改')) {
            abort(403);
        }
        $LegalAttestLetter->fill($request->only(["name","content"]));
        $LegalAttestLetter->save();
        //
        return redirect()->route('legal_attest_letters.edit', ["legal_attest_letter" => $LegalAttestLetter])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalAttestLetter $LegalAttestLetter)
    {
        if (! Gate::allows('存證信函管理_刪除')) {
            abort(403);
        }
        $LegalAttestLetter->delete();
        return redirect()->route('legal_attest_letters.index')->with("success",["刪除成功"]);
    }
}
