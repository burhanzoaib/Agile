<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\RoleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransportationController;








Route::group(['middleware' => ['auth']], function () {

    Route::resource('allbookings',\App\Http\Controllers\BookingController::class);


    Route::get('city_tour',[\App\Http\Controllers\CitytourController::class,'index'])->name('city.index');
    Route::get('city_tour/create',[\App\Http\Controllers\CitytourController::class,'create'])->name('city.create');
    Route::post('city_tour/store',[\App\Http\Controllers\CitytourController::class,'store'])->name('city.store');
    Route::get('city_tour/edit/{id}',[\App\Http\Controllers\CitytourController::class,'edit'])->name('city.edit');
    Route::put('city_tour/update/{id}',[\App\Http\Controllers\CitytourController::class,'update'])->name('city.update');
    Route::delete('city_tour/delete/{id}',[\App\Http\Controllers\CitytourController::class,'destroy'])->name('city.destroy');
    Route::get('city_tour/show/{id}',[\App\Http\Controllers\CitytourController::class,'show'])->name('city.show');
    Route::get('citybooking',[\App\Http\Controllers\CitytourController::class,'booking'])->name('city.booking');
    Route::get('citybooking/show/{id}',[\App\Http\Controllers\CitytourController::class,'showbooking'])->name('city.showbooking');
    Route::delete('/city_tour/{id}/delete-image/{index}', [\App\Http\Controllers\CitytourController::class,'deleteImage'])->name('city.delete-image');

    //attraction controller
    Route::get('attraction',[\App\Http\Controllers\AttractionController::class,'index'])->name('attraction.index');
    Route::get('attraction/create',[\App\Http\Controllers\AttractionController::class,'create'])->name('attraction.create');
    Route::post('attraction/store',[\App\Http\Controllers\AttractionController::class,'store'])->name('attraction.store');
    Route::get('attraction/edit/{id}',[\App\Http\Controllers\AttractionController::class,'edit'])->name('attraction.edit');
    Route::put('attraction/update/{id}',[\App\Http\Controllers\AttractionController::class,'update'])->name('attraction.update');
    Route::delete('attraction/delete/{id}',[\App\Http\Controllers\AttractionController::class,'destroy'])->name('attraction.destroy');
    Route::get('attraction/show/{id}',[\App\Http\Controllers\AttractionController::class,'show'])->name('attraction.show');
    Route::get('attractionbooking',[\App\Http\Controllers\AttractionController::class,'booking'])->name('attraction.booking');
    Route::get('attractionbooking/show/{id}',[\App\Http\Controllers\AttractionController::class,'showbooking'])->name('attraction.showbooking');
    Route::delete('/attraction/{id}/delete-image/{index}', [\App\Http\Controllers\AttractionController::class,'deleteImage'])->name('attraction.delete-image');


    //adventures
    Route::get('adventure',[\App\Http\Controllers\AdventureController::class,'index'])->name('adventure.index');
    Route::get('adventure/create',[\App\Http\Controllers\AdventureController::class,'create'])->name('adventure.create');
    Route::post('adventure/store',[\App\Http\Controllers\AdventureController::class,'store'])->name('adventure.store');
    Route::get('adventure/edit/{id}',[\App\Http\Controllers\AdventureController::class,'edit'])->name('adventure.edit');
    Route::put('adventure/update/{id}',[\App\Http\Controllers\AdventureController::class,'update'])->name('adventure.update');
    Route::delete('adventure/delete/{id}',[\App\Http\Controllers\AdventureController::class,'destroy'])->name('adventure.destroy');
    Route::get('adventure/show/{id}',[\App\Http\Controllers\AdventureController::class,'show'])->name('adventure.show');
    Route::get('adventurebooking',[\App\Http\Controllers\AdventureController::class,'booking'])->name('adventure.booking');
    Route::get('adventurebooking/show/{id}',[\App\Http\Controllers\AdventureController::class,'showbooking'])->name('adventure.showbooking');
    Route::delete('/adventure/{id}/delete-image/{index}', [\App\Http\Controllers\AdventureController::class,'deleteImage'])->name('adventure.delete-image');


    //luxury transportation
    Route::get('vip_transportation',[\App\Http\Controllers\VipTransportationController::class,'index'])->name('vip.index');
    Route::get('vip_transportation/create',[\App\Http\Controllers\VipTransportationController::class,'create'])->name('vip.create');
    Route::post('vip_transportation/store',[\App\Http\Controllers\VipTransportationController::class,'store'])->name('vip.store');
    Route::get('vip_transportation/edit/{id}',[\App\Http\Controllers\VipTransportationController::class,'edit'])->name('vip.edit');
    Route::put('vip_transportation/update/{id}',[\App\Http\Controllers\VipTransportationController::class,'update'])->name('vip.update');
    Route::delete('vip_transportation/delete/{id}',[\App\Http\Controllers\VipTransportationController::class,'destroy'])->name('vip.destroy');
    Route::get('vip_transportation/show/{id}',[\App\Http\Controllers\VipTransportationController::class,'show'])->name('vip.show');
    Route::get('viptransportationbooking',[\App\Http\Controllers\VipTransportationController::class,'booking'])->name('vip.booking');
    Route::get('viptransportationbooking/show/{id}',[\App\Http\Controllers\VipTransportationController::class,'showbooking'])->name('vip.showbooking');
    Route::delete('/vip_transportation/{id}/delete-image/{index}', [\App\Http\Controllers\VipTransportationController::class,'deleteImage'])->name('vip.delete-image');


//transportation
    Route::get('transportation',[\App\Http\Controllers\TransportationController::class,'index'])->name('transportation.index');

    Route::get('transportation/create',[\App\Http\Controllers\TransportationController::class,'create'])->name('transportation.create');
    Route::post('transportation/store',[\App\Http\Controllers\TransportationController::class,'store'])->name('transportation.store');
    Route::get('transportation/edit/{id}',[\App\Http\Controllers\TransportationController::class,'edit'])->name('transportation.edit');
    Route::put('transportation/update/{id}',[\App\Http\Controllers\TransportationController::class,'update'])->name('transportation.update');
    Route::delete('transportation/delete/{id}',[\App\Http\Controllers\TransportationController::class,'destroy'])->name('transportation.destroy');
    Route::get('transportation/show/{id}',[\App\Http\Controllers\TransportationController::class,'show'])->name('transportation.show');
    Route::get('transportationBooking',[\App\Http\Controllers\TransportationController::class,'booking'])->name('transportation.booking');
    Route::get('transportationbooking/show/{id}',[\App\Http\Controllers\TransportationController::class,'showbooking'])->name('transportation.showbooking');
    Route::delete('/transportation/{id}/delete-image/{index}', [\App\Http\Controllers\TransportationController::class,'deleteImage'])->name('transportation.delete-image');



    Route::get('featured/{type}/{id}',[\App\Http\Controllers\CitytourController::class,'featured'])->name('featured');
    Route::get('unfeatured/{type}/{id}',[\App\Http\Controllers\CitytourController::class,'unfeatured'])->name('unfeatured');



    Route::resource('role',RoleController::class);
    //flight data
    Route::get('flightdata',[\App\Http\Controllers\FlightController::class,'flightdata'])->name('flight.flightdata');
    Route::get('flightdata/show/{id}',[\App\Http\Controllers\FlightController::class,'showflightdata'])->name('flight.showflightdata');


    //settings

    Route::get('setting/edit',[\App\Http\Controllers\SettingController::class,'edit'])->name('setting.edit');
    Route::post('setting/update/{id}',[\App\Http\Controllers\SettingController::class,'setting_update'])->name('setting.update');


    Route::resource('customer',CustomerController::class);
	Route::get('user',[CustomerController::class,'user'])->name('customer.user');


    Route::resource('page',\App\Http\Controllers\PageController::class);


    Route::get('bannerslider',[\App\Http\Controllers\BannerSliderController::class,'index'])->name('banner.index');
    Route::get('bannerslider/create',[\App\Http\Controllers\BannerSliderController::class,'create'])->name('banner.create');
    Route::post('bannerslider/store',[\App\Http\Controllers\BannerSliderController::class,'store'])->name('banner.store');
    Route::get('bannerslider/show/{id}',[\App\Http\Controllers\BannerSliderController::class,'show'])->name('banner.show');
    Route::get('bannerslider/edit/{id}',[\App\Http\Controllers\BannerSliderController::class,'edit'])->name('banner.edit');
    Route::put('bannerslider/update/{id}',[\App\Http\Controllers\BannerSliderController::class,'update'])->name('banner.update');
    // Route::delete('bannerslider/delete/{id}',[\App\Http\Controllers\BannerSliderController::class,'destroy'])->name('banner.destroy');
    Route::delete('/bannerslider/{id}/delete-image/{index}', [\App\Http\Controllers\BannerSliderController::class,'deleteImage'])->name('bannerslider.delete-image');

    //reviews
    Route::get('reviews',[\App\Http\Controllers\ReviewsController::class,'index'])->name('review.index');
    Route::get('reviews/show/{id}',[\App\Http\Controllers\ReviewsController::class,'show'])->name('review.show');
    Route::delete('reviews/delete/{id}',[\App\Http\Controllers\ReviewsController::class,'destroy'])->name('review.destroy');



    //socialmedia
    Route::get('/socialmedia',[\App\Http\Controllers\SocialMediaController::class,'index'])->name('SocialMedia.index');
    Route::get('/socialmedia/show/{id}',[\App\Http\Controllers\SocialMediaController::class,'show'])->name('SocialMedia.show');
    Route::get('/socialmedia/edit/{id}',[\App\Http\Controllers\SocialMediaController::class,'edit'])->name('SocialMedia.edit');
    Route::put('/socialmedia/update/{id}',[\App\Http\Controllers\SocialMediaController::class,'update'])->name('SocialMedia.update');
    Route::delete('socialmedia/delete/{id}',[\App\Http\Controllers\SocialMediaController::class,'destroy'])->name('SocialMedia.destroy');


    //promocode
    Route::get('promocode',[\App\Http\Controllers\PromoCodeController::class,'index'])->name('promo.index');
    Route::get('promocode/create',[\App\Http\Controllers\PromoCodeController::class,'create'])->name('promo.create');
    Route::post('promocode/store',[\App\Http\Controllers\PromoCodeController::class,'store'])->name('promo.store');
    Route::get('promocode/edit/{id}',[\App\Http\Controllers\PromoCodeController::class,'edit'])->name('promo.edit');
    Route::put('promocode/update/{id}',[\App\Http\Controllers\PromoCodeController::class,'update'])->name('promo.update');
    Route::delete('promocode/delete/{id}',[\App\Http\Controllers\PromoCodeController::class,'destroy'])->name('promo.destroy');
    Route::get('promocode/show/{id}',[\App\Http\Controllers\PromoCodeController::class,'show'])->name('promo.show');

    //navbarlinks
    Route::get('/navbar',[\App\Http\Controllers\NavbarController::class,'index'])->name('navbar.index');
    Route::get('/navbar/show/{id}',[\App\Http\Controllers\NavbarController::class,'show'])->name('navbar.show');
    Route::get('/navbar/edit/{id}',[\App\Http\Controllers\NavbarController::class,'edit'])->name('navbar.edit');
    Route::put('/navbar/update/{id}',[\App\Http\Controllers\NavbarController::class,'update'])->name('navbar.update');
    Route::delete('navbar/delete/{id}',[\App\Http\Controllers\NavbarController::class,'destroy'])->name('navbar.destroy');

	Route::get('profile',[ProfileController::class,'index'])->name('profile.index');
    Route::post('profileupdate/{id}', [ProfileController::class,'profileupdate'])->name('profile.updatea');
    Route::post('profilepasswoerd/{id}', [ProfileController::class,'profilepasswoerd'])->name('profile.password');
	Route::get('settings',[ProfileController::class,'settings'])->name('profile.settings');
    // Route::post('setting_update/{id}', [ProfileController::class,'setting_update'])->name('setting.update');
    Route::post('state', [ProfileController::class,'state'])->name('profile.state');


    Route::get('users',[\App\Http\Controllers\RegisterController::class,'index'])->name('user.index');
    Route::get('form_create',[\App\Http\Controllers\RegisterController::class,'form_create'])->name('user.form_create');
    Route::post('user_store',[\App\Http\Controllers\RegisterController::class,'user_store'])->name('user.store');
    Route::get('user_edit/{id}',[\App\Http\Controllers\RegisterController::class,'edit'])->name('user.edit');
    Route::delete('user_store/delete/{id}',[\App\Http\Controllers\RegisterController::class,'destroy'])->name('user.destroy');
    Route::post('user_update/{id}',[\App\Http\Controllers\RegisterController::class,'user_update'])->name('user.user_update');


    Route::get('hotelbooking',[\App\Http\Controllers\HotelController::class,'hotelbooking'])->name('hotel.hotelbooking');
    Route::get('hotelDetail/{id}',[\App\Http\Controllers\HotelController::class,'hotelDetail'])->name('hotel.hotelDetail');


    Route::get('/clear-cache', function() {

    $exitCode = Artisan::call('queue:work');
    dd($exitCode);
    // return what you want
    });


});








Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get("/showtimer", function(){
    return View::make("showtimer");
 });

require __DIR__.'/auth.php';
