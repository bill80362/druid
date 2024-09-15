<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\PermissionGroup;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('帳號管理_讀取')) {
            abort(403);
        }
        $paginator = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->paginate();
        //
        return view('user.index', [
            "paginator" => $paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('帳號管理_新增')) {
            abort(403);
        }
        //
        $user = new User([]);
        //
        return view('user.create', [
            "item" => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if (! Gate::allows('帳號管理_新增')) {
            abort(403);
        }
        //
        $user = new User($request->all());
        $user->save();
        //
        return redirect()->route('users.index')->with("success",["新增成功"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (! Gate::allows('帳號管理_修改')) {
            abort(403);
        }
        //
        $user->load(["permissions"]);
        //
        return view('user.edit', [
            "item" => $user,
            "permissionGroups" => PermissionGroup::with(["permissions"])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (! Gate::allows('帳號管理_修改')) {
            abort(403);
        }
        $user->fill($request->only(["name","email"]));
        //
        if($request->get("password")){
            $user->password = $request->get("password");
        }
        $user->save();
        //
        $user->permissions()->sync($request->get('permissions'));
        //
        return redirect()->route('users.edit', ["user" => $user])->with("success",["儲存成功"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (! Gate::allows('帳號管理_刪除')) {
            abort(403);
        }
        $user->delete();
        return redirect()->route('users.index')->with("success",["刪除成功"]);
    }
}
