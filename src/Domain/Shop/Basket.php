<?php

namespace Domain\Shop;

use Domain\Shop\Models\Basket as BasketModel;
use Domain\Shop\Repositories\BasketRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class Basket
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $baskets;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->baskets = (new BasketRepository)->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItems(): Collection
    {
        return $this->baskets;
    }

    /**
     * @return int
     */
    public function countPositions(): int
    {
        return $this->baskets->count();
    }

    /**
     * @return int
     */
    public function total(): int
    {
        return $this->baskets->sum(function (BasketModel $basket): int {
            if (! $basket->product->quantity) {
                return 0;
            }

            return $basket->product->price() * $basket->count;
        });
    }
}
