<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = ['Сочи', 'Москва', 'Санкт-Петербург', 'Краснодар', 'Анапа'];
        
        return [
            'title' => fake('ru_RU')->sentence(3),
            'address' => fake('ru_RU')->address(),
            'city' => fake()->randomElement($cities),
            'price_per_night' => fake()->numberBetween(2000, 15000),
            'max_guests' => fake()->numberBetween(2, 8),
            'beds' => fake()->numberBetween(1, 4),
            'description' => fake('ru_RU')->paragraph(2),
            'attrs' => [],
        ];
    }
}
