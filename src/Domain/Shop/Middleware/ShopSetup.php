<?php

namespace Domain\Shop\Middleware;

use Closure;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopSetup
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard(SHOP_GUARD)->guest() && !Session::has(SHOP_SESSION_GUEST)) {
            Session::put(SHOP_SESSION_GUEST, Uuid::uuid1()->toString());
        }

        return $next($request);
    }
}
