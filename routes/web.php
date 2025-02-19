<?php

use App\Http\Controllers\AIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationMarkController;
use App\Http\Controllers\RealtorListingAcceptController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;

// this routes have no meaning at all i just did it initially to learn i will  remove it soon 
Route::get('/',[IndexController::class,'index']);
Route::get('/hello',[IndexController::class,'show'])->middleware('auth');

//resourceful route

Route::resource('listing', ListingController::class)->only('index','show');

//user registration resourceful routes 
Route::resource('user-account', UserAccountController::class)->only(['create','store']);

// routes for ai tools
Route::get('/ai',[AIController::class,'index']);
Route::get('/ai/propertyvaluation',[AIController::class,'propertyValuation']);
Route::get('ai/metrics',[AIController::class,'metrics']);

 //authenticating routes
 Route::get('login',[AuthController::class,'create'])->name('login');
 Route::post('login',[AuthController::class,'store'])->name('login.store');
Route::get('logout',[AuthController::class,'destroy'])->name('logout');

//making offers route and we only have store method it will be a resourceful route tho
Route::resource('listing.offer',ListingOfferController::class)->middleware('auth')->only('store');

// prefixi all the url with /realtor and named routes with realtor with a dot notation
Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(function (){
Route::resource('listing', RealtorListingController::class)->withTrashed();
Route::put('listing/{listing}/restore',[RealtorListingController::class,'restore'])->name('listing.restore')->withTrashed(); 
Route::put('/offer/{offer}/accept',RealtorListingAcceptController::class)->name('offer.accept');
Route::resource('listing.image',RealtorListingImageController::class)->only('create','store','destroy');
// route for rendering list of notifications
Route::resource('notification',NotificationController::class)->only(['index']);
Route::put('/notification/{notification}',NotificationMarkController::class)->name('notification.mark'); // when you are scaling add a policy inside the invoke method too
});