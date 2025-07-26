<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'author' => fake()->name,
            'description' => fake()->realText(200, 2),
            'content' => fake()->realText(1000, 2),
            'url' => fake()->url(),
            'image' => fake()->imageUrl(),
            'source' => fake()->name(),
            'category_id' => null, //Category::factory(),
        ];
    }
}
