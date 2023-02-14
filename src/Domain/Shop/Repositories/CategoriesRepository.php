<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class CategoriesRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function parents(): Collection
    {
        return Category::query()->whereNull('parent_id')->get();
    }

    /**
     * @param string $hru
     * @return \Domain\Shop\Models\Category
     */
    public function findByHru(string $hru): Category
    {
        return Category::query()->where('hru', $hru)->firstOrFail();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function children(): Collection
    {
        return Category::query()->whereNotNull('parent_id')->get();
    }
}
