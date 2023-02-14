<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Product;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Database\Eloquent\Collection;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class ProductsRepository
{
    /**
     * @param integer $id
     *
     * @return \Domain\Shop\Models\Product
     */
    public function findById(int $id): Product
    {
        return Product::query()->where('id', $id)->firstOrFail();
    }

    /**
     * @param string $hru
     *
     * @return \Domain\Shop\Models\Product
     */
    public function findByHru(string $hru): Product
    {
        return Product::query()->where('hru', $hru)->firstOrFail();
    }

    /**
     * @param \Domain\Shop\Requests\CatalogRequest $request
     *
     * @return mixed
     */
    public function catalog(CatalogRequest $request)
    {
        return Product::catalog($request)->paginate(24);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function popular(): Collection
    {
        return Product::query()->orderByDesc('count_views')->limit(12)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latest(): Collection
    {
        return Product::query()->orderByDesc('created_at')->limit(12)->get();
    }
}
