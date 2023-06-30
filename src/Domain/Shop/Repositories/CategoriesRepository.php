<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoriesRepository
{
    public function parents(): Collection
    {
        return Category::query()->whereNull('parent_id')->get();
    }

    public function findByHru(string $hru): Category
    {
        return Category::query()->where('hru', $hru)->firstOrFail();
    }

    public function children(): Collection
    {
        return Category::query()->whereNotNull('parent_id')->get();
    }

    public function any(): Collection
    {
        return Category::query()->get();
    }
}
