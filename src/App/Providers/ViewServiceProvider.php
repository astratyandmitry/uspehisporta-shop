<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(resource_path('domain/cms/views'), 'cms');
        $this->loadViewsFrom(resource_path('domain/shop/views'), 'shop');
    }
}
