<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        foreach (Permission::with(["group"])->get() as $permission){
            Gate::define($permission?->group?->name."_".$permission->name, function (User $user) use ($permission) {
                return $user->permissions->pluck("id")->contains($permission->id);
            });
        }


    }
}
