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
        //
        Paginator::useBootstrapFive();
        //
        try{
            foreach (Permission::with(["group"])->get() as $permission){
                Gate::define($permission?->group?->name."_".$permission->name, function (User $user) use ($permission) {
                    //先全開
                    return true;

                    return $user->permissions->pluck("id")->contains($permission->id);
                });
            }
        }catch (\Exception $e){

        }



    }
}
