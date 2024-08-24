<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image' => null,
            'price' => fake()->randomFloat(2, 1, 100),
            'short_description' => fake()->text(100),
            'qty' => fake()->randomDigit(),
            'shipping' => fake()->text(10),
            'weight' => fake()->randomFloat(2, 1, 10),
            'description' => fake()->randomHtml(3, 3),
            'information' => fake()->randomHtml(3, 3),
            'reviews' => fake()->randomHtml(3, 3),
            'status' => fake()->boolean(),
            'product_category_id' => fake()->randomElement(ProductCategory::pluck('id'))
        ];
    }
}
