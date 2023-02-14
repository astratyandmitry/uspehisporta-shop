<?php

namespace App;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * @var array
     */
    protected $middleware = [
        // \App\Middleware\TrustHosts::class,
        \App\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        'shop' => \Domain\Shop\Middleware\ShopSetup::class,
        'shop.guest' => \Domain\Shop\Middleware\RedirectIfAuthenticated::class,
        'shop.signed' => \Domain\Shop\Middleware\RedirectIfUnauthenticated::class,

        'cms.guest' => \Domain\CMS\Middleware\RedirectIfAuthenticated::class,
        'cms.signed' => \Domain\CMS\Middleware\RedirectIfUnauthenticated::class,
    ];
}
