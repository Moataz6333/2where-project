<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TraditionsController;
use App\Http\Controllers\AccessabilityController;
use App\Http\Controllers\SaftyController;
use App\Http\Controllers\RestaruantController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubsecriperController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\TourGideController;




Route::get('/admin',function(){
    return view('login');
})->name('login');

Route::post('/login',[UserController::class,'login'])->name('users.check');

Route::get('/logout',function(){
    auth()->logout();
    return to_route('login');
 })->name('logout')->middleware('auth');

Route::middleware(['auth:sanctum'])->group(function () {
   

Route::get('/register',function(){
    return view('register');
})->name('register');
Route::post('/register/store',[UserController::class,'store'])->name('users.store');






//web contnet
 //dashboard
    Route::get('/', DashboardController::class)->name('dashboard');

    //cities
Route::resource('/cities',CityController::class);
Route::resource('/places',PlaceController::class);

Route::get('/places/photos/{id}',[PlaceController::class,'photos'])->name('places.photos');
Route::post('/places/photos/{id}',[PlaceController::class,'storePhotos'])->name('places.storePhotos');
Route::post('/places/UpdatePhotos/{id}',[PlaceController::class,'updatePhotos'])->name('places.updatePhotos');
//photo
Route::get('cites-photos/{id}',[PhotoController::class,'citesPhotos'])->name('cites.photos');
Route::post('cites-photos/{id}',[PhotoController::class,'cities_CreatePhotos'])->name('cities.CreatePhotos');
Route::post('cites-photos/update/{id}',[PhotoController::class,'cities_UpdatePhotos'])->name('cities.UpdatePhotos');
Route::delete('cites-photos/delete/{id}',[PhotoController::class,'cities_DeletePhotos'])->name('cities.DeletePhotos');

//traditions
Route::get('tradition/{city}',[TraditionsController::class,'traditions'])->name('traditions.index');
Route::get('tradition/create/{city}',[TraditionsController::class,'create'])->name('traditions.create');
Route::get('tradition/update/{city}',[TraditionsController::class,'edit'])->name('traditions.edit');

Route::Post('tradition/update/{city}',[TraditionsController::class,'update'])->name('traditions.update');
Route::Post('tradition/{city}',[TraditionsController::class,'store'])->name('traditions.store');
Route::delete('tradition/{city}',[TraditionsController::class,'destroy'])->name('traditions.destroy');


//accessability
Route::get('/accessability/{place}',[AccessabilityController::class,'index'])->name('access.index');
Route::post('/accessability/update/{place}',[AccessabilityController::class,'update'])->name('access.update');
Route::post('/accessability/{place}',[AccessabilityController::class,'store'])->name('access.store');


//safty
Route::get('/safty/{city}',[SaftyController::class,'index'])->name('safty.index');
Route::post('/safty/{city}',[SaftyController::class,'store'])->name('safty.store');
Route::post('/safty/update/{city}',[SaftyController::class,'update'])->name('safty.update');
Route::post('/safty/updateDes/{city}',[SaftyController::class,'updateSaftyDescription'])->name('safty.updateSaftyDescription');
Route::delete('/safty/update/{city}',[SaftyController::class,'destroy'])->name('safty.destroy');

//rastraunt
Route::get('/restaruant/{city}',[RestaruantController::class,'index'])->name('rests.index');
Route::get('/restaruant/create/{city}',[RestaruantController::class,'create'])->name('rests.create');
Route::post('/restaruant/create/{city}',[RestaruantController::class,'store'])->name('rests.store');
Route::get('/restaruant/edit/{rest}',[RestaruantController::class,'edit'])->name('rests.edit');
Route::post('/restaruant/update/{rest}',[RestaruantController::class,'update'])->name('rests.update');
Route::delete('/restaruant/destroy/{rest}',[RestaruantController::class,'destroy'])->name('rests.destroy');
   //rest slider
   Route::get('/restaruant/photos/{rest}',[RestaruantController::class,'photos'])->name('rests.photos');
   Route::post('/restaruant/photoSlider/{rest}',[RestaruantController::class,'slider'])->name('rests.slider');
   Route::post('/restaruant/menu/{rest}',[RestaruantController::class,'menu'])->name('rests.menu');
   Route::post('/restaruant/updateSlider/{rest}',[RestaruantController::class,'slider_update'])->name('rests.slider_update');
   Route::delete('/restaruant/deleteSlider/{rest}',[RestaruantController::class,'slider_delete'])->name('rests.slider_delete');


//hotels
Route::get('/hotels/{city}',[HotelController::class,'index'])->name('hotels.index');
Route::get('/hotels/create/{city}',[HotelController::class,'create'])->name('hotels.create');
Route::post('/hotels/create/{city}',[HotelController::class,'store'])->name('hotels.store');
Route::get('/hotels/edit/{rest}',[HotelController::class,'edit'])->name('hotels.edit');
Route::post('/hotels/update/{rest}',[HotelController::class,'update'])->name('hotels.update');
Route::delete('/hotels/destroy/{rest}',[HotelController::class,'destroy'])->name('hotels.destroy');
 //rest slider
 Route::get('/hotel/photos/{rest}',[HotelController::class,'photos'])->name('hotels.photos');
 Route::post('/hotel/photoSlider/{rest}',[HotelController::class,'slider'])->name('hotels.slider');
 Route::post('/hotel/updateSlider/{rest}',[HotelController::class,'slider_update'])->name('hotels.slider_update');
 Route::delete('/hotel/deleteSlider/{rest}',[HotelController::class,'slider_delete'])->name('hotels.slider_delete');

    //plans

    Route::resource('/plans',PlanController::class);

    //api view
    Route::view('/api-view','api.index')->name('api.view');
    Route::view('/get-api','api.get_api')->name('api.get');
    Route::view('/post-api','api.post_api')->name('api.post');

    //subsercipers
    Route::get('/subsecripers',[SubsecriperController::class,'index'])->name('subs.index');
    Route::post('/subsecripers',[SubsecriperController::class,'create'])->name('subs.store');
    Route::view('/subs','subsecripers.create');
    Route::view('/view','subsecripers.design');
    Route::delete('/subsecripers/{id}',[SubsecriperController::class,'destroy'])->name('subs.destroy');
    Route::get('/sendemail',[SubsecriperController::class,'email'])->name('subs.email');
    Route::post('/send',[SubsecriperController::class,'send'])->name('email.send');

    Route::get('test',[PhotoController::class,'test']);
    Route::get('/clear/{dir}/{id}',[PhotoController::class,'clear'])->name('clear');
    
    //clear photos
    Route::get('clear-photos',[PhotoController::class,'clear_photos'])->name('clear-photos');
    Route::get('clear-userRests',[PhotoController::class,'clear_userRests'])->name('clear-userRests');
    Route::get('clear-userHotels',[PhotoController::class,'clear_userHotels'])->name('clear-userHotels');
    
    //requests page
    Route::get('/requests',[RequestController::class,'index'])->name('requests.index');
    Route::get('/show-rest/{id}',[RequestController::class,'show'])->name('rest.show');
    Route::get('/accept-rest/{id}',[RequestController::class,'accept'])->name('rest.accept');
    Route::get('/show-hotel/{id}',[RequestController::class,'show_hotel'])->name('hotel.show');
    Route::get('/accept-hotel/{id}',[RequestController::class,'accept_hotel'])->name('hotel.accept');

    // tour guides
    Route::get('tour-guides', [TourGideController::class,'index'])->name('tourGuide.index');
    Route::get('tour-guides/accept/{id}', [TourGideController::class,'accept'])->name('tourGuide.accept');
    Route::get('tour-guides/email/{id}', [TourGideController::class,'email'])->name('tourGuide.email');
    Route::post('tour-guides/send-email/{id}', [TourGideController::class,'send_email'])->name('tourGuide.send');
    Route::delete('tour-guides/destroy/{id}', [TourGideController::class,'destroy'])->name('tourGuide.destroy');



    
});