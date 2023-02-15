<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Product;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductsRepository
{
    public function findById(int $id): Product
    {
        return Product::query()->where('id', $id)->firstOrFail();
    }

    public function findByHru(string $hru): Product
    {
        return Product::query()->where('hru', $hru)->firstOrFail();
    }

    public function catalog(CatalogRequest $request): LengthAwarePaginator
    {
        return Product::catalog($request)->paginate(24);
    }

    public function popular(): Collection
    {
        return Product::query()->orderByDesc('count_views')->limit(12)->get();
    }

    public function latest(): Collection
    {
        return Product::query()->orderByDesc('created_at')->limit(12)->get();
    }
}
