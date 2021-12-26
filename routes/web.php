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
//DB::listen(function($query) {
//    var_dump($query->sql, $query->bindings);
//});

//Route::get('/', function () {
//    return view('welcome');
//});


//Auth::routes();


//Route::get('/pay', 'HomeController@pay')->name('pay');
//Route::get('/delivery', 'HomeController@delivery')->name('delivery');
//Route::get('/contact', 'HomeController@contact')->name('contact');
use Illuminate\Support\Facades\DB;

Route::get('/bonus', 'HomeController@bonus')->name('bonus');
//Route::get('/cabinet', 'HomeController@cabinet')->middleware('auth')->name('cabinet');
Route::post('/client', 'HomeController@saveClient')->middleware('auth')->name('client');
Route::post('/contact/feedback', 'HomeController@sendFeedback');

// Корзина

Route::get('/cart', 'CartController@cart')->name('cart');
Route::get('/checkout', 'CartController@checkout')->name('checkout');
Route::get('/complete', 'CartController@complete')->name('complete');


//Route::get('/foods', 'FoodController@index')->name('foods.index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check.admin']], function () {
    Route::get('/', 'Admin\AdminController@index')->name('admin.index');
    Route::post('/sms/activate/{login}', 'Admin\SmsController@activate')->name('admin.sms.activate1');

    Route::get('/promotion-cards/refresh', 'Admin\PromotionCardsController@refresh')->name('promotion-cards.refresh');

    Route::resources([
        'categories'        => 'Admin\CategoryController',
        'food'              => 'Admin\FoodController',
        'coupon'            => 'Admin\CouponController',
        'order'             => 'Admin\OrderController',
        'ingridients'       => 'Admin\IngridientController',
        'option-categories' => 'Admin\CategoryOptionController',
        'options'           => 'Admin\OptionController',
        'setting'           => 'Admin\SettingController',
        'site-setting'      => 'Admin\SiteSettingController',
        'sms'               => 'Admin\SmsController',
        'promotions'        => 'Admin\PromotionsController',
        'promotion-cards'   => 'Admin\PromotionCardsController',
    ]);

    Route::put('/ingridients/{ingridientID}/{foodID}',
        'Admin\IngridientController@updateStatus')->name('ingridients.update-status');
});

Route::group(['prefix' => 'food'], function () {
    Route::get('/category/{slug}', 'FoodController@byCategorySlug')->name('food.by-category-slug');
    Route::get('/search', 'FoodController@bySearch')->name('food.by-search');
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/success-pay', 'OrderController@webhook');

    Route::group(['prefix' => 'cart'], function () {


    });
});

Route::get('/order/{id}', 'Admin\OrderController@show');

Route::post('/app/settings', 'Api\V1\AppController@settings');
Route::post('/app/siteSettings', 'Api\V1\AppController@siteSettings');
Route::get('/app/cacheClear', 'Api\V1\AppController@cacheClear')->middleware('check.admin')->name('cache:clear');

Route::post('/promotions/cards', 'Api\V1\PromotionCardsApiController@index');

// SPA routes //

Route::get('/', function () {
    return view('welcome');
})->name('home');

// WITH AUTH routes //

Route::post('/auth/login', 'Auth\LoginController@login')->name('login');
Route::post('/auth/registration', 'Auth\RegisterController@register')->name('register');
Route::post('/auth/activate', 'Auth\RegisterController@confirm')->name('confirmPhone');

Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('reset');
Route::post('/password/phone', 'Auth\ForgotPasswordController@sendResetLinkPhone')->name('resetPhone');
Route::post('/password/phone/checkCode', 'Auth\ForgotPasswordController@checkResetCode');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::post('/password/newPassword', 'Auth\ResetPasswordController@reset');
Route::post('/password/newPasswordPhone', 'Auth\ResetPasswordController@resetPhone');
Route::post('/password/newPassword/{token}/{id?}', 'Auth\ResetPasswordController@getResetToken');


Route::get('/password/newPassword/{token}/{id?}', function ($url) {
    return view('welcome');
})->name('newPasswordPage');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// user orders //
Route::get('/user/orders', 'HomeController@userOrders')->middleware('auth')->name('userOrders');

Route::get('/{url}', function ($url) {
    return view('welcome');
})->where(['url' => 'menu|promotions|pay|contact|delivery|login|register|cabinet|password/reset|auth/activate']);
