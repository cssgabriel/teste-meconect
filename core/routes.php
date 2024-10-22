<?php

use Project\Meconect\Facades\Route;
use Project\Meconect\Middlewares\Auth;
use Project\Meconect\Controllers\{
    AccountController,
    HomeController,
    PrivateController,
};

# GET
Route::get("/", [HomeController::class, "index"]);
Route::post("/", [HomeController::class, "login"]);
Route::get("/register", [AccountController::class, "create"]);
Route::post("/register", [AccountController::class, "save"]);
Route::get("/protected-route", [PrivateController::class, "index"])->middleware(Auth::class);

# INIT
Route::watch();
