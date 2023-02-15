<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\OrdersRepository;
use Domain\Shop\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderDetailController extends Controller
{
    public function __invoke(string $uuid, Request $request, OrdersRepository $repository): View
    {
        $order = $repository->findByUuidAndId((int)$request->get('id'), $uuid);

        abort_if($order === null, redirect()->route('shop::home'));

        $this->setup(PAGE_ACCOUNT_ORDER)->hideBreadcrumbs();

        return $this->view('order.detail', [
            'order' => $order,
        ]);
    }
}
