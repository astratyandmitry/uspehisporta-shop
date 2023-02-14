<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class BrandsRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection
    {
        return Brand::query()->get();
    }
}
