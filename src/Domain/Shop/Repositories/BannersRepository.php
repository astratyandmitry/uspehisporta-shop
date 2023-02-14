<?php

namespace Domain\Shop\Repositories;

use Domain\Shop\Models\Banner;
use Illuminate\Database\Eloquent\Collection;

class BannersRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function main(): Collection
    {
        return Banner::query()->where('position_key', BANNER_POS_HOME_MAIN)->latest()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function productsSplit(): Collection
    {
        return Banner::query()->where('position_key', BANNER_POS_PRODUCTS_SPLIT)->inRandomOrder()->limit(2)->get();
    }
}
