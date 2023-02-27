<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    protected string $shopControllersNamespace = 'Domain\Shop\Controllers';

    protected string $cmsControllersNamespace = 'Domain\CMS\Controllers';

    public function map(): void
    {
        $this->removeIndexPhpFromUrl();

        $this->mapShopRoutes();
        $this->mapCMSRoutes();
    }

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

    protected function mapShopRoutes(): void
    {
        Route::get('api/settings', function(): \Illuminate\Http\JsonResponse {
            return response()->json(['settings' =>\Domain\Shop\Models\Settings::options()]);
        });

        Route::middleware(['web', 'shop'])
            ->as('shop::')
            ->namespace($this->shopControllersNamespace)
            ->group(base_path('routes/shop.php'));
    }

    protected function mapCMSRoutes(): void
    {
        Route::middleware('web')
            ->prefix('cms')
            ->as('cms::')
            ->namespace($this->cmsControllersNamespace)
            ->group(base_path('routes/cms.php'));
    }
}
