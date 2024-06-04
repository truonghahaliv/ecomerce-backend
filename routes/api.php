<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
Route::post("register", [\App\Http\Controllers\Auth\RegisterController::class,"register"]);
Route::post("login", [LoginController::class,"login"]);

Route::apiResource("products", ProductController::class);
Route::apiResource("users", \App\Http\Controllers\Admin\UserController::class);
Route::apiResource("categories", \App\Http\Controllers\Admin\CategoryController::class);

Route::get("profile", [\App\Http\Controllers\Profile\ProfileController::class,"profile"]);
Route::group(["middleware" => "auth:sanctum"], function () {


    Route::get("logout", [LoginController::class,"logout"]);
});
