<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

class BrandsRepository
{
    public function all(): Collection
    {
        return Brand::query()->get();
    }
}
