<?php

namespace Database\Factories;

use Domain\Shop\Models\Product;
use Illuminate\Support\Str;
use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $badges = ['Майские скидки', '-10%', '-20%', 'Новинка', 'Акция'];
        $badgesArray = [];
        $countBadges = rand(0, 3);

        if ($countBadges > 0) {
            for ($i = 0; $i < $countBadges; $i++) {
                $randomBadge = $badges[array_rand($badges)];
                if (! in_array($randomBadge, $badgesArray)) {
                    $badgesArray[] = $randomBadge;
                }
            }
        }

        return [
            'category_id' => Category::query()->inRandomOrder()->value('id'),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'name' => Str::title($title = $this->faker->words(3, true)),
            'hru' => Str::slug($title),
            'image' => '/images/products/'.rand(1, 6).'.jpeg',
            'about' => '<p>'.implode('</p></p>', $this->faker->paragraphs(2)).'</p>',
            'quantity' => rand(0, 100),
            'price' => rand(1000, 10000),
            'active' => true,
            'hot_sale' => rand(0, 1),
            'variations' => [],
            'badges' => count($badgesArray) ? implode(',', $badgesArray) : null,
        ];
    }
}
