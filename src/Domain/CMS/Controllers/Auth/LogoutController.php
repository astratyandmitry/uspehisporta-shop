<?php

namespace Domain\CMS\Controllers\Auth;

use Domain\CMS\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Auth::guard('cms')->logout();

        return $this->redirect('login');
    }
}
