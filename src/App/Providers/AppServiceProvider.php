<?php

namespace App\Providers;

use Domain\Shop\Basket;
use Domain\Shop\Catalog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('basket', Basket::class);
        $this->app->singleton('catalog', Catalog::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator): bool {
            return Hash::check($value, optional(auth('shop')->user())->password);
        });
    }
}
