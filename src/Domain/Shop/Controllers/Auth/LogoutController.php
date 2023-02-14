<?php

namespace Domain\Shop\Controllers\Auth;

use Domain\Shop\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class LogoutController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(): RedirectResponse
    {
        Auth::guard(SHOP_GUARD)->logout();

        session()->forget('auth.redirect');

        return $this->redirect('home');
    }
}
