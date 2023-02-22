<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Database\Factories\ReviewFactory;
use Database\Factories\TestimonialFactory;
use Domain\Shop\Models\Product;
use Domain\Shop\Models\Review;
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
        TestimonialFactory::new()->count(8)->create();

        Schema::enableForeignKeyConstraints();
    }
}
