<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

Route::get("/", [HomeController::class, "index"]);

Route::get("/login", [LoginController::class, "login"])->name("login");
Route::get("/logout", [LoginController::class, "logout"])->name("logout")->middleware("auth");
Route::post("/login", [LoginController::class, "login_submit"])->name("login-submit");

Route::get("/register", [RegisterController::class, "register"])->name("register");
Route::post("/register/store", [RegisterController::class, "store"])->name("register-store");

Route::group(["prefix" => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get("/profile", [ProfileController::class, "profile"])->name("profile");
        Route::put("/profile/update", [ProfileController::class, "update"])->name("profile.update");
        Route::get("/profile/delete", [ProfileController::class, "delete"])->name("profile.delete");
    });
});
