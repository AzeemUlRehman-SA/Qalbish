<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('otp', 'Api\AuthController@otp');
Route::post('verify/otp', 'Api\AuthController@verifyOTP');
Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::post('forgot-password-request', 'Api\AuthController@ForgotPasswordRequest');
Route::get('cities', 'Api\GeneralController@cities');
Route::get('areas/{city_id}', 'Api\GeneralController@areas');
Route::get('settings', 'Api\GeneralController@settings');
Route::get('genders', 'Api\GeneralController@genders');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('update-profile', 'Api\GeneralController@updateProfile');
    Route::post('update-password', 'Api\GeneralController@updatePassword');
    Route::post('update-profile-image', 'Api\GeneralController@updateProfileImage');
    Route::get('services', 'Api\GeneralController@services');
    Route::get('discounts', 'Api\GeneralController@discounts');
    Route::get('packages', 'Api\GeneralController@packages');
    Route::get('user-referral', 'Api\GeneralController@userReferral');
    Route::post('coupon', 'Api\GeneralController@coupon');
    Route::get('orders', 'Api\OrderController@orders');
    Route::post('orders/store', 'Api\OrderController@store');
    Route::post('orders/rating', 'Api\OrderController@rating');
    Route::post('logout', 'Api\AuthController@logout');
    Route::get('user', 'Api\AuthController@getUser');

    Route::post('get-lat-lng', 'Api\GeneralController@getLatLong');
    Route::post('store-lat-lng', 'Api\GeneralController@saveLatLong');

    Route::prefix('staff')->group(function () {
        Route::get('appointments', 'Api\StaffController@appointments');
        Route::post('update-order-staff-status', 'Api\StaffController@updateOrderStaffStatus');
        Route::post('update-order-progress-status', 'Api\StaffController@updateOrderProgressStatus');
    });

});

Route::fallback(function () {
    return response()->json(['message' => 'URL Not Found'], 404);
});
