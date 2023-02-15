<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::guard(SHOP_GUARD)->logout();

        session()->forget('auth.redirect');

        return $this->redirect('home');
    }
}
