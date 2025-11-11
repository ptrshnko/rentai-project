<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenity>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amenities = [
            'Wi-Fi',
            'Кондиционер',
            'Телевизор',
            'Стиральная машина',
            'Парковка',
            'Балкон',
            'Кухня',
        ];
        
        return [
            'name' => fake()->unique()->randomElement($amenities),
        ];
    }
}
