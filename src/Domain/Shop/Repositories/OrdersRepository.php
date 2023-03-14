<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Basket;
use Domain\Shop\Models\Basket as BasketModel;
use Domain\Shop\Models\Order;
use Domain\Shop\Models\OrderItem;
use Domain\Shop\Requests\OrderRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class OrdersRepository
{
    public function current(): LengthAwarePaginator
    {
        return Order::query()
            ->where('status_key', ORDER_STATUS_CREATED)
            ->where('user_id', auth(SHOP_GUARD)->id())
            ->paginate(12);
    }

    public function history(): LengthAwarePaginator
    {
        return Order::query()
            ->where('status_key', '!=', ORDER_STATUS_CREATED)
            ->where('user_id', auth(SHOP_GUARD)->id())
            ->paginate(12);
    }

    public function findById(int $id): Order
    {
        return Order::query()->where('id', $id)->with('items')->firstOrFail();
    }

    public function findByUuidAndId(int $id, ?string $uuid = null): ?Order
    {
        return Order::query()->where([
            'uuid' => $uuid,
            'id' => $id,
        ])->first();
    }

    public function create(OrderRequest $request, Basket $basket): Order
    {
        $order = new Order;
        $order->client_name = "{$request->last_name} {$request->first_name}";
        $order->client_phone = $request->phone;
        $order->client_email = $request->email;
        $order->delivery_address = "{$request->city}, {$request->street} (Индек: {$request->postcode})";
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

    public function last(): ?Order
    {
        return Order::query()
            ->whereNotNull('user_id')
            ->where('user_id', auth(SHOP_GUARD)->id())
            ->latest()->first();
    }
}
