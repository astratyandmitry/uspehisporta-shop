<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Category;
use Domain\Shop\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
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
        'category_id' => Category::query()->inRandomOrder()->whereNotNull('parent_id')->value('id'),
        'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        'name' => Str::title($title = $faker->words(3, true)),
        'hru' => Str::slug($title),
        'image' => '/images/products/'.rand(1, 6).'.jpeg',
        'about' => '<p>'.implode('</p></p>', $faker->paragraphs(2)).'</p>',
        'active' => true,
        'badges' => count($badgesArray) ? implode(',', $badgesArray) : null,
    ];
});
