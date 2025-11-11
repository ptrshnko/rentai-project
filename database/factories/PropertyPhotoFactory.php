<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyPhoto>
 */
class PropertyPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => \App\Models\Property::factory(),
            'path' => 'storage/properties/demo' . fake()->numberBetween(1, 10) . '.jpg',
            'is_cover' => false,
            'sort_order' => 0,
        ];
    }
}
