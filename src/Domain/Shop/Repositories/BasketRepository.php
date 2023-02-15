<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Basket;
use Domain\Shop\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class BasketRepository
{
    private string $owner_column;

    private string|int $owner_value;

    public function __construct()
    {
        if (auth(SHOP_GUARD)->check()) {
            $this->owner_column = 'user_id';
            $this->owner_value = auth(SHOP_GUARD)->id();
        } else {
            $this->owner_column = 'session_key';
            $this->owner_value = session()->get(SHOP_SESSION_GUEST);
        }
    }

    public function all(): Collection
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('count', '>', 0)
            ->whereHas('product')
            ->get();
    }

    public function findById(int $id): Basket
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function deleteById(int $id): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('id', $id)
            ->delete();
    }

    public function findByProduct(Product $product, ?string $variation = null): Basket
    {
        return Basket::query()->firstOrCreate([
            $this->owner_column => $this->owner_value,
            'product_id' => $product->id,
            'variation' => $variation,
        ]);
    }

    public function updateCount(int $id, int $count): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->where('id', $id)
            ->update(['count' => $count]);
    }

    public function clear(): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->delete();
    }

    public function migrateFromGuest(int $user_id): bool
    {
        return Basket::query()
            ->where($this->owner_column, $this->owner_value)
            ->update([
                'session_key' => null,
                'user_id' => $user_id,
            ]);
    }
}
