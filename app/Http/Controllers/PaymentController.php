<?php

namespace App\Http\Controllers;

use App\Models\PermissionGroup;
use App\Models\Payment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('付款方式管理_讀取')) {
            abort(403);
        }
        //
        return view('payment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('付款方式管理_新增')) {
            abort(403);
        }
        //
        $Payment = new Payment([]);
        //
        return view('payment.create', [
            "item" => $Payment,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('付款方式管理_新增')) {
            abort(403);
        }
        //
        $Payment = new Payment($request->all());
        $Payment->save();
        //
        return redirect()->route('payments.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $Payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $Payment)
    {
        if (! Gate::allows('付款方式管理_修改')) {
            abort(403);
        }
        //
        return view('payment.edit', [
            "item" => $Payment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $Payment)
    {
        if (! Gate::allows('付款方式管理_修改')) {
            abort(403);
        }
        $Payment->fill($request->only(["name","content"]));
        $Payment->save();
        //
        return redirect()->route('payments.edit', ["payment" => $Payment])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $Payment)
    {
        if (! Gate::allows('付款方式管理_刪除')) {
            abort(403);
        }
        $Payment->delete();
        return redirect()->route('payments.index')->with("success",["刪除成功"]);
    }
}
