<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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

        foreach ($amenities as $name) {
            Amenity::firstOrCreate(['name' => $name]);
        }
    }
}
