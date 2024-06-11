<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;

Route::middleware('guest')->group(function () {

    Route::post("register", [\App\Http\Controllers\Auth\RegisterController::class, "register"]);
    Route::post("login", [AuthenticationController::class, "login"]);


});
Route::group(["middleware" => "auth:api"], function () {

    Route::get("logout", [AuthenticationController::class, "logout"]);
    Route::get("profile", [\App\Http\Controllers\Profile\ProfileController::class, "profile"]);
    Route::apiResource("products", ProductController::class);
    Route::apiResource("users", \App\Http\Controllers\Admin\UserController::class);
    Route::apiResource("categories", \App\Http\Controllers\Admin\CategoryController::class);
    Route::apiResource("permissions", \App\Http\Controllers\Admin\PermissionController::class);
    Route::apiResource("roles", \App\Http\Controllers\Admin\RoleController::class);

});




