<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Models\Promo;
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

        $promo = Promo::query()
            ->where('code', request()->query('promo'))
            ->where('date_start', '<=', now())
            ->where('date_end', '>=', now())
            ->first();

        return $this->view('order.form', [
            'promo' => $promo,
        ]);
    }
}
