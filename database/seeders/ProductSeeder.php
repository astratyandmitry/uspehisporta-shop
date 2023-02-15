<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Database\Factories\ReviewFactory;
use Domain\Shop\Models\Packing;
use Domain\Shop\Models\Product;
use Domain\Shop\Models\ProductPacking;
use Domain\Shop\Models\ProductStock;
use Domain\Shop\Models\ProductTaste;
use Domain\Shop\Models\Review;
use Domain\Shop\Models\Taste;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Product::query()->truncate();
        Review::query()->truncate();

        ProductFactory::new()->count(50)->create();
        ReviewFactory::new()->count(100)->create();

        Schema::enableForeignKeyConstraints();
    }
}
