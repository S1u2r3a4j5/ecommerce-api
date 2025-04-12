<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
   
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true), // e.g. "Smart Wireless Mouse"
            'description' => $this->faker->paragraph, // random 3-4 line ka description
            'price' => $this->faker->randomFloat(2, 100, 1000), // 100 se 1000 tak ka price
            'stock' => $this->faker->numberBetween(1, 100), // 1 se 100 tak stock
            'image_url' => $this->faker->imageUrl(), // random image URL
            'category_id' => rand(1, 5), // maan le 5 categories hain
        ];
    }
}
