<?php

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


Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::get('/cache', function () {

    \Illuminate\Support\Facades\Artisan::call('key:generate');
//    \Illuminate\Support\Facades\Artisan::call('storage:link');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');

//    \Illuminate\Support\Facades\Artisan::call('passport:install');
//    \Illuminate\Support\Facades\Artisan::call('migrate');

    return 'Commands run successfully Cleared.';
});


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('/register/{referral_code?}', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');


Route::post('otp', 'Auth\ForgotPasswordController@otp')->name('otp.send');
Route::post('verify/otp', 'Auth\ForgotPasswordController@verifyOTP')->name('verify.otp');
Route::post('forgot-password-request', 'Auth\ForgotPasswordController@ForgotPasswordRequest')->name('otp.password.reset');

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('/dashboard', 'Backend\DashboardController');
        Route::resource('/meta-tags', 'Backend\MetaTagController', [
            'only' => ['index', 'create', 'store', 'edit', 'update']
        ]);
        Route::resource('/cities', 'Backend\CityController');
        Route::resource('/areas', 'Backend\AreaController');
        Route::post('/areas/import/file', 'Backend\AreaController@importFile')->name('area.import.excel');
        Route::resource('/users', 'Backend\UserController');
        Route::post('/users/location', 'Backend\UserController@updateLocation')->name('user.location');
        Route::resource('/category', 'Backend\ServiceController');
        Route::resource('/services', 'Backend\CategoryController');
        Route::resource('/menu-items', 'Backend\SubCategoryController');
        Route::resource('/addons', 'Backend\AddOnsController');
        Route::resource('/packages', 'Backend\DealController');
        Route::resource('/special-offers', 'Backend\BlogController');
        Route::resource('/category-blogs', 'Backend\BlogCategoryController');
        Route::resource('/testimonial', 'Backend\TestimonialController',
            ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
            ]);
        Route::resource('/managing-parteners', 'Backend\ManagingPartenerController');
        Route::resource('/membership-details', 'Backend\MembershipDetailsController', [
            'only' => ['index', 'store']
        ]);
        Route::resource('/memberships', 'Backend\MembershipController', [
            'only' => ['index', 'edit', 'update']
        ]);

        Route::resource('/settings', 'Backend\SettingController', [
            'only' => ['index', 'edit', 'update']
        ]);
        Route::resource('/contacts', 'Backend\ContactUsController', [
            'only' => ['index', 'destroy']
        ]);
        Route::resource('/aboutus', 'Backend\AboutUsController', [
            'only' => ['index', 'store']
        ]);

        Route::resource('/privacypolicy', 'Backend\PrivacyController', [
            'only' => ['index', 'store']
        ]);


        Route::get('/discounts', 'Backend\DiscountController@index')->name('discount.index');
        Route::resource('/coupons', 'Backend\CouponController');

        Route::resource('/first-order-discount', 'Backend\FirstOrderDisountController', [
            'only' => ['edit', 'update']
        ]);

        Route::resource('/memberships-discount', 'Backend\MembershipDisountController', [
            'only' => ['edit', 'update']
        ]);

        Route::resource('/referral-discount', 'Backend\ReferralDisountController', [
            'only' => ['edit', 'update']
        ]);

        Route::get('/user-referrals', 'Backend\ReferralController@index')->name('user.referral.index');

        //User Order History

        Route::get('/order-history', 'Backend\OrderController@index')->name('get.order.history');
        Route::get('/order/create', 'Backend\OrderController@create')->name('order.create');
        Route::post('/order/store', 'Backend\OrderController@store')->name('order.store');
        Route::get('/order/{id}', 'Backend\OrderController@showOrder')->name('get.user.order.show');
        Route::get('/order/edit/{id}', 'Backend\OrderController@editOrder')->name('get.user.order.edit');
        Route::post('/order/update', 'Backend\OrderController@updateOrder')->name('order.update');
        Route::delete('/order/delete/{id}', 'Backend\OrderController@destroy')->name('get.user.order.delete');


        //Assign Driver

        Route::get('/driver', 'Backend\StaffController@index')->name('get.employee.user');


        //User Profiles
        Route::get('profile', 'Backend\ProfileController@index')->name('profile.index');

        Route::get('edit/profile', 'Backend\ProfileController@editProfile')->name('profile.edit');
        Route::post('edit/profile/image', 'Backend\ProfileController@editProfileImage')->name('profile.edit.image');
        Route::post('update/profile', 'Backend\ProfileController@updateProfile')->name('update.user.profile');

        Route::get('update/password/', 'Backend\ProfileController@changePassword')->name('update.password');
        Route::post('update/user/password/', 'Backend\ProfileController@updatePassword')->name('update.user.password');

        Route::get('update/phone', 'Backend\ProfileController@changeMobileNumber')->name('update.phone');
        Route::post('update/phone', 'Backend\ProfileController@updateMobileNumber')->name('update.user.phone');


    });
    //route for referral code
    Route::get('/referral-code', 'Backend\SendReferralCodeController@index')->name('referral-code.index');
    Route::post('/referral-code/send', 'Backend\SendReferralCodeController@sendCodeWithEmail')->name('referral-code.send');
    Route::get('/sendsms/{phone}/{message}', 'Backend\SendReferralCodeController@sendCodeWithPhone');


    //Customer Routes
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', 'Customer\MainController@index')->name('dashboard.index');
        Route::post('/coupons', 'Customer\CouponController@store')->name('coupons.store');
        Route::delete('/coupons', 'Customer\CouponController@destroy')->name('coupons.destroy');


        //User Profiles
        Route::get('profile', 'Customer\ProfileController@index')->name('profile.index');

        Route::get('edit/profile', 'Customer\ProfileController@editProfile')->name('profile.edit');
        Route::post('edit/profile/image', 'Customer\ProfileController@editProfileImage')->name('profile.edit.image');
        Route::post('update/profile', 'Customer\ProfileController@updateProfile')->name('update.user.profile');

        Route::get('update/password/', 'Customer\ProfileController@changePassword')->name('update.password');
        Route::post('update/user/password/', 'Customer\ProfileController@updatePassword')->name('update.user.password');

        Route::get('update/phone', 'Customer\ProfileController@changeMobileNumber')->name('update.phone');
        Route::post('update/phone', 'Customer\ProfileController@updateMobileNumber')->name('update.user.phone');


        //User Referrals
        Route::get('referrals', 'Customer\ReferralController@index')->name('user.referral');


        //User Order History

        Route::get('/order-history', 'Customer\OrderController@index')->name('order.history');
        Route::get('/order/{id}', 'Customer\OrderController@showOrder')->name('user.order.show');
    });


});
//Landing Page Routes

Route::get('services', 'Frontend\ServiceController@index')->name('service');
Route::get('services/{slug}', 'Frontend\ServiceController@serviceItems')->name('service.items');
Route::get('special-offer/{slug}', 'Frontend\BlogController@getBlog')->name('blog.show');
Route::get('special-offers', 'Frontend\BlogController@index')->name('blog');
Route::post('special-offers', 'Frontend\BlogController@loadBlogAjax')->name('blog.load.more');
Route::get('special-offers/{slug}', 'Frontend\BlogController@categoryBlog')->name('category.blogs');
Route::get('about-us', 'Frontend\AboutUsController@index')->name('aboutus.detail');
Route::get('/get/team/{id}', 'Frontend\ManagingPartenerController@showmodal');
Route::get('package/{slug}', 'Frontend\PackageController@getPackage')->name('package.show');
Route::get('packages', 'Frontend\PackageController@index')->name('packages');
Route::get('memberships', 'Frontend\MembershipController@index')->name('memberships');
Route::get('order-details', 'Frontend\OrderController@orderDetail')->name('order.details');
Route::get('order-reviews', 'Frontend\OrderController@orderReview')->name('order.review');
Route::post('order', 'Frontend\OrderController@finalOrder')->name('order.final');
Route::post('getservicesname', 'Frontend\ServiceController@getservicesname')->name('getservicesname');
Route::get('privacy-policy', function () {
    $privacyPolicy = \App\Models\PrivacyPolicy::first();
    return view('frontend.pages.privacy-policy',compact('privacyPolicy'));
})->name('privacy.policy');


//Ajax Routes
Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::get('city_areas', 'Backend\AjaxController@cityArea')->name('cityAreas');
    Route::get('service_category', 'Backend\AjaxController@serviceCategory')->name('serviceCategory');
    Route::get('service_sub_category', 'Backend\AjaxController@serviceSubCategory')->name('serviceSubCategory');
    Route::post('package_service_sub_category', 'Backend\AjaxController@packageServiceSubCategory')->name('packageServiceSubCategory');
    Route::get('service_sub_category_addon', 'Backend\AjaxController@serviceSubCategoryAddon')->name('serviceSubCategoryAddon');
    Route::get('assign/membership', 'Backend\AjaxController@assignMembership')->name('assign.membership');
    Route::get('order/status', 'Backend\AjaxController@orderStatus')->name('order.status');
    Route::get('assign/staff', 'Backend\AjaxController@assignStaff')->name('assign.staff');
    Route::get('order/latlng', 'Backend\AjaxController@getLatLng')->name('get.latlng');
    Route::get('assign/driver', 'Backend\AjaxController@assignDriver')->name('assign.driver');
    Route::get('customer/services', 'Backend\AjaxController@customerServiceCategory')->name('customerServiceCategory');
    Route::get('customer/getDiscounts', 'Backend\AjaxController@getDiscounts')->name('getDiscounts');
    Route::post('order/staff/rating', 'Backend\AjaxController@staffRating')->name('order.staff.rating');


});


Route::resource('/contacts', 'Backend\ContactUsController', [
    'only' => ['create', 'store']
]);


Route::get('/contacts', 'Backend\ContactUsController@create')->name('contacts.create');
Route::post('/contacts/store', 'Backend\ContactUsController@store')->name('contacts.store');

