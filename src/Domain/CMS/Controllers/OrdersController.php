<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Order;
use Domain\Shop\Models\OrderStatus;
use Illuminate\Http\RedirectResponse;

class OrdersController extends Controller
{
    protected string $section = SECTION_MAIN;

    protected string $model = 'orders';

    protected bool $addable = false;

    public function __construct()
    {
        $this->with('statuses', OrderStatus::query()->oldest()->pluck('name', 'id')->toArray());
    }

    public function show(int $id): View
    {
        $model = Order::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    public function index(): View
    {
        return $this->view([
            'models' => Order::filter()->paginate($this->paginationSize()),
        ]);
    }

    public function complete(int $id): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Order $model */
        $model = Order::query()->where(['id' => $id, 'status_key' => ORDER_STATUS_CREATED])->firstOrFail();
        $model->changeStatus(ORDER_STATUS_COMPLETED);

        return $this->redirectSuccess('show', ['order' => $id]);
    }

    public function cancel(int $id): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Order $model */
        $model = Order::query()->where(['id' => $id, 'status_key' => ORDER_STATUS_CREATED])->firstOrFail();
        $model->changeStatus(ORDER_STATUS_CANCELED);

        return $this->redirectDanger('show', ['order' => $id]);
    }
}
