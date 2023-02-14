<?php

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
        Taste::query()->truncate();
        Packing::query()->truncate();
        ProductPacking::query()->truncate();
        ProductTaste::query()->truncate();
        ProductStock::query()->truncate();

        factory(Product::class, 50)->create();

        /** @var \Domain\Shop\Models\Product[] $products */
        $products = Product::query()->get();

        Taste::query()->create(['name' => 'Обычный', 'hru' => 'def']);
        Packing::query()->create(['name' => 'Обычный', 'hru' => 'def']);

        foreach ($products as $product) {
            $product->packing()->create(['packing_id' => 1, 'price' => $price = rand(1000, 10000)]);
            $product->tastes()->create(['taste_id' => 1]);

            foreach (\Domain\Shop\Models\City::query()->pluck('id')->toArray() as $cityId) {
                $quantity = rand(2, 10);

                $product->remains()->create([
                    'packing_id' => 1,
                    'taste_id' => 1,
                    'city_id' => $cityId,
                    'quantity' => $quantity,
                ]);

                $product->stocks()->create([
                    'city_id' => $cityId,
                    'packing_id' => 1,
                    'taste_id' => 1,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }

            if (rand(1, 2) === 2) {
                continue;
            }

            factory(Review::class, rand(1, 10))->create([
                'product_id' => $product->id,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
