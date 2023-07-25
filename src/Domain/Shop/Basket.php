<?php

namespace Domain\Shop;

use Domain\Shop\Models\Basket as BasketModel;
use Domain\Shop\Models\Promo;
use Domain\Shop\Repositories\BasketRepository;
use Illuminate\Database\Eloquent\Collection;

class Basket
{
    protected Collection $baskets;

    public function __construct()
    {
        $this->baskets = (new BasketRepository)->all();
    }

    public function getItems(): Collection
    {
        return $this->baskets;
    }

    public function countPositions(): int
    {
        return $this->baskets->count();
    }

    public function total(): int
    {
        return $this->baskets->sum(function (BasketModel $basket): int {
            if (! $basket->product->quantity) {
                return 0;
            }

            return $basket->product->price() * $basket->count;
        });
    }

    public function discount(Promo $promo): int
    {
        $discount = 0;

        foreach ($this->baskets as $basket) {
            if (in_array($basket->product->category_id, $promo->categories)) {
                $discount += $basket->total * $promo->discount;
            }
        }

        return $discount;
    }
}
