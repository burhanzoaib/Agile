<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CitytourController;
use App\Http\Controllers\Api\AttractionController;
use App\Http\Controllers\Api\AdventureController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\SocialMediaController;
use App\Http\Controllers\Api\NavbarController;
use App\Http\Controllers\Api\ReviewsController;
use App\Http\Controllers\Api\PromoCodeController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\TransportationController;







/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('page/{slug}',[PageController::class,'page']);
Route::get('all_page_name',[PageController::class,'all_page_name']);
Route::get('getLogo', [PageController::class, 'getLogo']);



Route::get('city_tour',[CitytourController::class,'index']);
Route::get('city_tour/{id}',[CitytourController::class,'show']);


//attraction
Route::get('attraction',[AttractionController::class,'index']);
Route::get('attraction/{id}',[AttractionController::class,'show']);


//Adventure
Route::get('adventure',[AdventureController::class,'index']);
Route::get('adventure/{id}',[AdventureController::class,'show']);

//viptransportation
Route::get('vip_transportation',[CitytourController::class,'vip_transport']);


//transportation
Route::get('transportation',[TransportationController::class,'index']);
Route::get('transportation/{id}',[TransportationController::class,'show']);

Route::post('flightsearchOffer',[FlightController::class,'flightsearchOffer']);
Route::post('flightOfferPrice',[FlightController::class,'flightOfferPrice']);
Route::post('flightOfferCreate',[FlightController::class,'flightOfferCreate']);
Route::post('FlightOfferCreateDetails',[FlightController::class,'FlightOfferCreateDetails']);
Route::post('flightfiltersearch',[FlightController::class,'flightfiltersearch']);
Route::get('/cities/{iso2}',[FlightController::class,'getCitiesByISO2']);




//wishlist
Route::get('wishlist/{id}', [WishlistController::class,'getWishlist']);
Route::get('wishlistDelete/{wishlistItemId}', [WishlistController::class,'deleteWishlistItem']);


Route::post('hotelsearchCity',[HotelController::class,'hotelsearchCity']);
Route::post('hotelsearch',[HotelController::class,'hotelsearch']);
Route::post('TrendingHotels',[HotelController::class,'TrendingHotels']);


// Route::get('main',[HotelController::class,'main']);
Route::get('/getMapData', [HotelController::class, 'getMapData']);
Route::get('/get-place-id', [HotelController::class, 'getPlaceId']);
Route::get('/place-details/{placeId}', [HotelController::class, 'placeDetails']);
Route::get('/place-photos/{photoReference}', [HotelController::class, 'placePhotos']);
Route::get('/main', [HotelController::class, 'main']);



//socialmedia
Route::get('/socialmedialinks', [SocialMediaController::class, 'index']);
//navbar
Route::get('/navbarlinks', [NavbarController::class, 'index']);

//bannerslider
Route::get('/bannersliders', [SocialMediaController::class, 'bannerslider']);


// login and register api
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::post('/forgotpassword', [AuthController::class, 'forgotpassword']);
Route::post('/checkotp', [AuthController::class, 'Checkotp']);

Route::get('reviews/{activity_type}/{activity_id}', [ReviewsController::class, 'getReviews']);
Route::get('reviewsbyrating/{activity_type}/{activity_id}/{rating}', [ReviewsController::class, 'reviewsbyrating']);
Route::post('promocode/validate', [PromoCodeController::class, 'validateCode']);

//adtocart



Route::middleware('auth:sanctum')->group(function () {

    Route::post('bookingAttraction',[AttractionController::class,'booking']);
    Route::post('bookingCity',[CitytourController::class,'booking']);
    Route::post('/bookings',[BookingController::class,'booking']);
    Route::post('hotelbooking',[HotelController::class,'hotelbooking']);
    Route::post('adminData',[HotelController::class,'adminData']);
    Route::post('bookingAdventure',[AdventureController::class,'booking']);
    Route::post('addtowishlist',[WishlistController::class,'addToWishlist']);
    Route::post('reviews',[ReviewsController::class,'storeReviews']);
    Route::post('addtocart',[CartController::class,'addTocart']);
    Route::get('cart/{id}', [CartController::class,'getCartItems']);
    Route::get('cartDelete/{cartItemId}', [CartController::class,'deleteCartItem']);


});


