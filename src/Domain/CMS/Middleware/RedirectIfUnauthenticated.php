<?php

namespace Domain\CMS\Middleware;

use Closure;
use Domain\CMS\Models\Manager;
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
        if (Auth::guard('cms')->guest()) {
            if ($request->has('token')) {
                @list($id, $telegram_id, $email) = explode('_', base64_decode($request->get('token')));

                /** @var \Domain\CMS\Models\Manager $manager */
                $manager = Manager::query()
                    ->where('id', $id)
                    ->where('telegram_id', $telegram_id)
                    ->where('email', str_replace('-', '@', $email))
                    ->first();

                if ($manager) {
                    Auth::guard('cms')->loginUsingId($manager->id);

                    return $next($request);
                }
            }

            return redirect()->route('cms::login');
        }

        return $next($request);
    }
}
