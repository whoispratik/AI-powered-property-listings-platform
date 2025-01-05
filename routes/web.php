<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/',[IndexController::class,'index']);
Route::get('/hello',[IndexController::class,'show']);
Route::resource('listing', ListingController::class); //resourceful route