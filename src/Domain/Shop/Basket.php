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
        /** @var \Domain\Shop\Models\Basket $basket */
        foreach ($this->baskets as $basket) {
            if (checkArraySimilarity($promo->categories, $basket->product->categories_ids)) {
                if (is_array($promo->brands) && count($promo->brands)) {
                    if (! in_array($basket->product->brand_id, $promo->brands)) {
                        continue;
                    }
                }

                $discount += $basket->total * $promo->discount;
            }
        }

        return $discount;
    }
}
