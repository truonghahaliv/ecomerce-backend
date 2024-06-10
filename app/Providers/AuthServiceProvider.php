<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
//        $roles = Role::with('permissions')->get();
//
//
//        $permissionsArray = [];
//        foreach ($roles as $role) {
//
//            foreach ($role->permissions as $permissions) {
//                $permissionsArray[$permissions->name] [] = $role->name;
//
//            }
//
//
//        }
//
//
//// Every permission may have multiple roles assigned
//        foreach ($permissionsArray as $name => $roles) {
//
//            Gate::define($name, function ($user) use ($roles) {
//                // We check if we have the needed roles among current user's roles
////                dd(count(array_intersect($user->roles->pluck('name')->toArray(), $roles)));
//                return count(array_intersect($user->roles->pluck('name')->toArray(), $roles));
//            }
//
//            );
//
//
//        }

    }
}
