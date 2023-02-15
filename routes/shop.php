<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController')->name('home');
Route::get('/page/{page}', 'PageController')->name('page');

Route::get('/search', 'SearchController')->name('search');
Route::get('/catalog', 'CategoriesController')->name('categories');
Route::get('/catalog/product/{hru}', 'ProductController')->name('product');
Route::get('/catalog/{parentHru}/{childHru?}', 'CatalogController')->name('catalog');

Route::get('/order-{uuid}', 'OrderDetailController')->name('order');
Route::get('/basket', 'BasketController@index')->name('basket');
Route::post('/basket', 'BasketController@store')->name('basket.store');
Route::post('/basket/increase', 'BasketController@increase')->name('basket.increase');
Route::post('/basket/decrease', 'BasketController@decrease')->name('basket.decrease');
Route::delete('/basket/{id}', 'BasketController@destroy')->name('basket.destroy');
Route::post('/order', 'OrderCheckoutController')->name('checkout');

Route::middleware('shop.signed')->group(function (): void {
    Route::get('/catalog/product/{hru}/review', 'ProductReviewController@form')->name('product.review');
    Route::post('/catalog/product/{hru}/review', 'ProductReviewController@process');
});

Route::prefix('account')->as('account.')->namespace('Account')->middleware('shop.signed')->group(function (): void {
    Route::redirect('/', '/account/orders/current')->name('redirect');

    Route::get('/settings/personal', 'PersonalSettingsController@form')->name('settings.personal');
    Route::post('/settings/personal', 'PersonalSettingsController@process');
    Route::get('/settings/security', 'SecuritySettingsController@form')->name('settings.security');
    Route::post('/settings/security', 'SecuritySettingsController@process');

    Route::get('/orders/current', 'OrdersController@current')->name('orders.current');
    Route::get('/orders/history', 'OrdersController@history')->name('orders.history');
    Route::get('/orders/{id}', 'OrdersController@show')->name('order');
});

Route::prefix('auth')->as('auth.')->namespace('Auth')->group(function (): void {
    Route::middleware('shop.guest')->group(function (): void {
        Route::get('/login', 'LoginController@form')->name('login');
        Route::post('/login', 'LoginController@process');

        Route::get('/register', 'RegisterController@form')->name('register');
        Route::post('/register', 'RegisterController@process');

        Route::get('/password/recovery', 'PasswordRecoveryController@form')->name('password.recovery');
        Route::post('/password/recovery', 'PasswordRecoveryController@process');

        Route::get('/password/reset/{code}', 'PasswordResetController@form')->name('password.reset');
        Route::post('/password/reset/{code}', 'PasswordResetController@process');

        Route::get('/verification/{email}/{code}', 'VerificationController')->name('verification');
    });

    Route::middleware('shop.signed')->group(function (): void {
        Route::get('/logout', 'LogoutController')->name('logout');
    });
});
