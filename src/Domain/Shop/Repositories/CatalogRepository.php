<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Product;
use Domain\Shop\Requests\CatalogRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CatalogRepository
{
    public function find(CatalogRequest $request): LengthAwarePaginator
    {
        return Product::catalog($request)->paginate(24);
    }

    public function latest(): Collection
    {
        return Product::catalog()->orderByDesc('created_at')->limit(8)->get();
    }

    public function popular(): Collection
    {
        return Product::catalog()->orderByDesc('count_views')->limit(8)->get();
    }
}
