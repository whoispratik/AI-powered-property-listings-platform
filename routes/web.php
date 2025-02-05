<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;

// this routes have no meaning at all i just did it initially to learn i will  remove it soon 
Route::get('/',[IndexController::class,'index']);
Route::get('/hello',[IndexController::class,'show'])->middleware('auth');

//resourceful route

Route::resource('listing', ListingController::class)->only('index','show')->withTrashed(['show']);

//user registration resourceful routes 
Route::resource('user-account', UserAccountController::class)->only(['create','store']);

 //authenticating routes
 Route::get('login',[AuthController::class,'create'])->name('login');
 Route::post('login',[AuthController::class,'store'])->name('login.store');
Route::get('logout',[AuthController::class,'destroy'])->name('logout');

//making offers route and we only have store method it will be a resourceful route tho
Route::resource('listing.offer',ListingOfferController::class)->middleware('auth')->only('store');

// prefixi all the url with /realtor and named routes with realtor with a dot notation
Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function (){
Route::resource('listing', RealtorListingController::class)->except('show')->middleware('auth')->withTrashed(['edit']);
Route::put('listing/{listing}/restore',[RealtorListingController::class,'restore'])->name('listing.restore')->withTrashed(); 
Route::resource('listing.image',RealtorListingImageController::class)->only('create','store','destroy');
});