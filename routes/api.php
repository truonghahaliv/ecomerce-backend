<?php

use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;


Route::post("register", [\App\Http\Controllers\Api\Auth\RegisterController::class, "register"]);
    Route::post("login", [AuthenticationController::class, "login"]);


Route::group(["middleware" => "auth:api"], function () {

    Route::post('logout', [AuthenticationController::class, 'logout'])
        ->name('logout');

});

Route::apiResource("products", ProductController::class);
Route::apiResource("users", \App\Http\Controllers\Api\Admin\UserController::class);
Route::apiResource("categories", \App\Http\Controllers\Api\Admin\CategoryController::class);
Route::apiResource("permissions", \App\Http\Controllers\Api\Admin\PermissionController::class);
Route::apiResource("roles", \App\Http\Controllers\Api\Admin\RoleController::class);




