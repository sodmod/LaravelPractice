<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//Route::view('/', 'posts.index')->name('home');
Route::redirect("/", "posts");

Route::resource("posts", PostController::class);

Route::get('/{user}/posts', [DashboardController::class, 'usersPost'])
    ->name('posts.user');

Route::middleware("auth")->group(function (){
    // logout
    Route::post("/logout", [AuthController::class, "logout"])
        ->name("logout");
    // dashboard
    Route::get("/dashboard", [DashboardController::class, "index"])
        ->middleware("auth")
        ->name("dashboard");
});

Route::middleware("guest")->group(function () {
    Route::view("/login", 'auth.login')
        ->name('login');

    Route::post("/login", [AuthController::class, "login"])
        ->name("login");

    Route::view('/register', 'auth.register')
        ->name('register');

    Route::post("/register", [AuthController::class, "register"])
        ->middleware("guest")
        ->name("register");
});
