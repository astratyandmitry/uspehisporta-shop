<?php

namespace Database\Factories;

use Domain\Shop\Models\Product;
use Domain\Shop\Models\Testimonial;
use Illuminate\Support\Str;
use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
 */
class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'author' => $this->faker->userName,
            'message' => $this->faker->paragraph,
            'url' => '#',
            'active' => true,
        ];
    }
}
