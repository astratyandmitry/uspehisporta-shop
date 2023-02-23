<?php

namespace Domain\Shop\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderFormController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        if (!app('basket')->total()) {
            return redirect()->route('shop::basket');
        }

        $this->setup(PAGE_CHECKOUT);

        return $this->view('order.form');
    }
}
