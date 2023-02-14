<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Order;
use Domain\Shop\Models\OrderStatus;
use Illuminate\Http\RedirectResponse;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class OrdersController extends Controller
{
    /**
     * @var string
     */
    protected $section = SECTION_MAIN;

    /**
     * @var string
     */
    protected $model = 'orders';

    /**
     * @var bool
     */
    protected $addable = false;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->with('statuses', OrderStatus::query()->oldest()->pluck('name', 'id')->toArray());
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        $model = Order::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return $this->view([
            'models' => Order::filter()->paginate($this->paginationSize()),
        ]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete(int $id): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Order $model */
        $model = Order::query()->where(['id' => $id, 'status_key' => ORDER_STATUS_CREATED])->firstOrFail();
        $model->changeStatus(ORDER_STATUS_COMPLETED);

        return $this->redirectSuccess('show', ['order' => $id]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(int $id): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Order $model */
        $model = Order::query()->where(['id' => $id, 'status_key' => ORDER_STATUS_CREATED])->firstOrFail();
        $model->changeStatus(ORDER_STATUS_CANCELED);

        return $this->redirectDanger('show', ['order' => $id]);
    }
}
