<?php

namespace Domain\Shop\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard(SHOP_GUARD)->check()) {
            return redirect()->route('shop::home');
        }

        return $next($request);
    }
}
