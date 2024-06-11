<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\AuthCode;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
//        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

//        Passport::useTokenModel(Token::class);
//        Passport::useRefreshTokenModel(RefreshToken::class);
//        Passport::useAuthCodeModel(AuthCode::class);
//        Passport::useClientModel(Client::class);
//        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        Passport::enablePasswordGrant();
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
