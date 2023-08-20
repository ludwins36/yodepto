<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RecaptchaController;
use App\Http\Controllers\RentalOfferController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::post('getRoomieRentalOffersForHomeWeb', [RentalOfferController::class, 'getRoomieRentalOffersForHomeWeb']);
Route::post('getOwnerRentalOffersForHomeWeb', [RentalOfferController::class, 'getOwnerRentalOffersForHomeWeb']);
Route::post('sendContactFormMail', [MailController::class, 'sendContactFormMail']);

//
//Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(
    function(){
        Route::post('logout', [PassportAuthController::class, 'logout']);

        Route::apiResource('users', UserController::class);
        Route::post('users/changeRol', [UserController::class, 'changeRol']);
        Route::post('users/changeStatus', [UserController::class, 'changeStatus']);
        Route::post('users/updateUser', [UserController::class, 'updateUser']);

        Route::apiResource('roles', RolController::class);

        Route::apiResource('plans', PlanController::class);
        Route::post('plans/update', [PlanController::class, 'update']);
        //Route::post('plans/store', [PlanController::class, 'store']);
        Route::get('plans/getActivePlans', [PlanController::class, 'getActivePlans']);

        Route::apiResource('rentalOffers', RentalOfferController::class);
        Route::post('rentalOffers/updateDescription', [RentalOfferController::class, 'updateDescription']);
        Route::post('rentalOffers/changeStatus', [RentalOfferController::class, 'changeStatus']);
        Route::get('rentalOffers/getUserRentalOffers/{userId}', [RentalOfferController::class, 'getUserRentalOffers']);

        Route::get('favorites/getFavoritesForUser/{userId}', [FavoriteController::class, 'getFavoritesForUser']);
        Route::post('favorites/setFavoritesForUser', [FavoriteController::class, 'setFavoritesForUser']);
        Route::post('favorites/removeFavoritesForUser', [FavoriteController::class, 'removeFavoritesForUser']);

        Route::apiResource('payment', PaymentController::class);
        Route::post('payment/updatePlan', [PaymentController::class, 'updatePlan']);

        Route::post('recaptcha', [RecaptchaController::class, 'verifyRecaptcha']);

        Route::apiResource('cities', CityController::class);
        Route::apiResource('provinces', ProvinceController::class);
        Route::apiResource('countries', CountryController::class);
    }
);

