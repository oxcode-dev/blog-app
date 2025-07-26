<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $categories = [
        'sport', 'global news', 'business', 'local news',
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'name' => $category = fake()->randomElement($this->categories),
            'slug' => Str::slug($category) . '-' . Str::strtotime(now()),
            'description' => fake()->realText($maxNbChars = 500, $indexSize = 2),
        ];
    }
}
