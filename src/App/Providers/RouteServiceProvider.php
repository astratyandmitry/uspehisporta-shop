<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $shopControllersNamespace = 'Domain\Shop\Controllers';

    /**
     * @var string
     */
    protected $cmsControllersNamespace = 'Domain\CMS\Controllers';

    /**
     * @return void
     */
    public function map(): void
    {
        $this->removeIndexPhpFromUrl();

        $this->mapShopRoutes();
        $this->mapCMSRoutes();
    }
    /**
     * @return void
     */
    protected function removeIndexPhpFromUrl(): void
    {
        if (Str::contains(request()->getRequestUri(), '/index.php/')) {
            $url = str_replace('index.php/', '', request()->getRequestUri());

            if (strlen($url) > 0) {
                header("Location: $url", true, 301);

                exit;
            }
        }
    }

    /**
     * @return void
     */
    protected function mapShopRoutes(): void
    {
        Route::middleware(['web', 'shop'])
            ->as('shop::')
            ->namespace($this->shopControllersNamespace)
            ->group(base_path('routes/shop.php'));
    }

    /**
     * @return void
     */
    protected function mapCMSRoutes(): void
    {
        Route::middleware('web')
            ->prefix('cms')
            ->as('cms::')
            ->namespace($this->cmsControllersNamespace)
            ->group(base_path('routes/cms.php'));
    }
}
