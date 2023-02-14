<?php

namespace Domain\Shop\Controllers\Account;

use Domain\Shop\Controllers\Controller;
use Domain\Shop\Models\Page;
use Domain\Shop\Repositories\OrdersRepository;
use Illuminate\View\View;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class OrdersController extends Controller
{
    /**
     * @param \Domain\Shop\Repositories\OrdersRepository $repository
     * @return \Illuminate\View\View
     */
    public function current(OrdersRepository $repository): View
    {
        $this->layout->addBreadcrumb('Личный кабинет', route('shop::account.redirect'));
        $this->setup(PAGE_ACCOUNT_ORDERS_CURRENT);

        return $this->view('account.orders.list', [
            'orders' => $repository->current(),
        ]);
    }

    /**
     * @param \Domain\Shop\Repositories\OrdersRepository $repository
     * @return \Illuminate\View\View
     */
    public function history(OrdersRepository $repository): View
    {
        $this->layout->addBreadcrumb('Личный кабинет', route('shop::account.redirect'));
        $this->setup(PAGE_ACCOUNT_ORDERS_HISTORY);

        return $this->view('account.orders.list', [
            'orders' => $repository->history(),
        ]);
    }

    /**
     * @param int $id
     * @param \Domain\Shop\Repositories\OrdersRepository $repository
     * @return \Illuminate\View\View
     */
    public function show(int $id, OrdersRepository $repository): View
    {
        $order = $repository->findById($id);
        $order->load(['items', 'items.product', 'items.product.brand']);

        abort_unless($order->user_id === auth(SHOP_GUARD)->id(), 404);

        $this->layout
            ->addBreadcrumb('Личный кабинет', route('shop::account.redirect'))
            ->addBreadcrumb('Заказы', route('shop::account.orders.'.($order->current() ? 'current' : 'history')));

        $this->setup(PAGE_ACCOUNT_ORDER);

        return $this->view('account.orders.show', [
            'order' => $order,
        ]);
    }
}
