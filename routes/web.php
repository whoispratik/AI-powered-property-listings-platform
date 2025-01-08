<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/',[IndexController::class,'index']);
Route::get('/hello',[IndexController::class,'show'])->middleware('auth');
//resourceful route
Route::resource('listing', ListingController::class)->middleware('auth');
 //authenticating routes
 Route::get('login',[AuthController::class,'create'])->name('login');
 Route::post('login',[AuthController::class,'store'])->name('login.store');
Route::get('logout',[AuthController::class,'destroy'])->name('logout');