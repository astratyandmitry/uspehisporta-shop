<?php

namespace Domain\CMS\Controllers;

use Illuminate\Http\RedirectResponse;

class AppController extends Controller
{
    public function home(): RedirectResponse
    {
        return $this->redirect('orders.index');
    }
}
