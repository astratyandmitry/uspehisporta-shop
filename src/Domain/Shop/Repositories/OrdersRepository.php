<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Basket;
use Domain\Shop\Models\Basket as BasketModel;
use Domain\Shop\Models\Order;
use Domain\Shop\Models\OrderItem;
use Domain\Shop\Requests\OrderRequest;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class OrdersRepository
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function current()
    {
        return Order::query()
            ->where('status_key', ORDER_STATUS_CREATED)
            ->where('user_id', auth(SHOP_GUARD)->id())
            ->paginate(12);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function history()
    {
        return Order::query()
            ->where('status_key', '!=', ORDER_STATUS_CREATED)
            ->where('user_id', auth(SHOP_GUARD)->id())
            ->paginate(12);
    }

    /**
     * @param int $id
     *
     * @return \Domain\Shop\Models\Order
     */
    public function findById(int $id): Order
    {
        return Order::query()->where('id', $id)->with('items')->firstOrFail();
    }

    /**
     * @param int $id
     * @param string|null $uuid
     *
     * @return \Domain\Shop\Models\Order|null
     */
    public function findByUuidAndId(int $id, ?string $uuid = null): ?Order
    {
        return Order::query()
            ->where('uuid', $uuid)
            ->where('id', $id)
            ->first();
    }

    /**
     * @param \Domain\Shop\Requests\OrderRequest $request
     * @param \Domain\Shop\Basket $basket
     * @return \Domain\Shop\Models\Order
     */
    public function create(OrderRequest $request, Basket $basket): Order
    {
        $order = new Order;
        $order->client_name = $request->name;
        $order->client_phone = $request->phone;
        $order->client_email = $request->email;
        $order->delivery_address = $request->address;
        $order->comment = $request->comment;
        $order->delivery_price = config('shop.delivery_price');
        $order->total = $basket->total();
        $order->status_key = ORDER_STATUS_CREATED;

        if ($user_id = auth(SHOP_GUARD)->id()) {
            $order->user_id = $user_id;
        }

        $order->save();

        foreach ($basket->getItems() as $basketItem) {
            $this->addItem($order, $basketItem);
        }

        return $order;
    }

    /**
     * @param \Domain\Shop\Models\Order $order
     * @param \Domain\Shop\Models\Basket $basket
     *
     * @return \Domain\Shop\Models\OrderItem
     */
    public function addItem(Order $order, BasketModel $basket): OrderItem
    {
        return $order->items()->create([
            'product_id' => $basket->product_id,
            'variation' => $basket->product->variations[$basket->variation]['name'] ?? null,
            'count' => $basket->count,
            'price' => $basket->product->price(),
            'total' => $basket->count * $basket->product->price(),
        ]);
    }

    /**
     * @return \Domain\Shop\Models\Order|null
     */
    public function last(): ?Order
    {
        return Order::query()
            ->whereNotNull('user_id')
            ->where('user_id', auth(SHOP_GUARD)->id())
            ->latest()->first();
    }
}
