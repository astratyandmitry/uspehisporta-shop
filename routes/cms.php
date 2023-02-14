<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AppController@home')->name('home');

Route::prefix('auth')->namespace('Auth')->group(function (): void {
    Route::middleware('cms.guest')->group(function (): void {
        Route::get('/login', 'LoginController@form')->name('login');
        Route::post('/login', 'LoginController@process');
    });

    Route::middleware('cms.signed')->group(function (): void {
        Route::get('/logout', 'LogoutController')->name('logout');
    });
});

Route::middleware('cms.signed')->group(function (): void {
    // Custom
    Route::post('/active-switch', 'CRUDController@activeSwitch')->name('switch');
    Route::post('/update-sorting', 'CRUDController@updateSorting')->name('sorting');

    // Uploads
    Route::post('/uploads', 'UploadsController@upload');
    Route::delete('/uploads', 'UploadsController@delete');

    // Orders
    Route::resource('orders', 'OrdersController')->only(['index', 'show']);
    Route::post('/orders/{id}/complete', 'OrdersController@complete')->name('orders.complete');
    Route::post('/orders/{id}/cancel', 'OrdersController@cancel')->name('orders.cancel');

    // Reviews
    Route::resource('reviews', 'ReviewsController')->only(['index', 'show', 'destroy']);

    // Resources
    Route::resources([
        'products' => 'ProductsController',
        'pages' => 'PagesController',
        'categories' => 'CategoriesController',
        'brands' => 'BrandsController',
        'managers' => 'ManagersController',
        'banners' => 'BannersController',
    ]);
});
