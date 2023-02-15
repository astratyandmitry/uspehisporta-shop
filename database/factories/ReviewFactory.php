<?php

namespace Database\Factories;

use Domain\Shop\Models\Product;
use Domain\Shop\Models\Review;
use Domain\Shop\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::query()->inRandomOrder()->value('id'),
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'message' => $this->faker->sentence(20),
            'username' => $this->faker->firstName,
            'rating' => rand(3, 5),
            'active' => true,
        ];
    }
}
