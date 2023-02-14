<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Catalog;
use Domain\Shop\Models\Product;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Database\Eloquent\Collection;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class CatalogRepository
{
    /**
     * @param \Domain\Shop\Requests\CatalogRequest $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function find(CatalogRequest $request)
    {
        return Product::catalog($request)->paginate(24);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function popular(): Collection
    {
        return Product::catalog()->orderByDesc('count_views')->limit(8)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function featured(): Collection
    {
        return Product::catalog()->where('featured', true)->limit(8)->inRandomOrder()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latest(): Collection
    {
        return Product::catalog()->orderByDesc('created_at')->limit(8)->get();
    }
}
