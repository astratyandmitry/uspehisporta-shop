<?php

namespace Domain\Shop\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfUnauthenticated
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard(SHOP_GUARD)->guest()) {
            session()->put('auth.redirect', $request->getRequestUri());

            return redirect()->route('shop::auth.login');
        }

        return $next($request);
    }
}
