<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyPhoto;
use App\Models\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'title' => 'Уютная квартира в центре Сочи',
                'address' => 'ул. Навагинская, 16',
                'city' => 'Сочи',
                'price_per_night' => 4500,
                'max_guests' => 4,
                'beds' => 2,
                'description' => 'Современная квартира с видом на море. В шаговой доступности пляж и центр города.',
                'photos' => [
                    ['path' => 'storage/properties/demo1.jpg', 'is_cover' => true, 'sort_order' => 0],
                    ['path' => 'storage/properties/demo2.jpg', 'is_cover' => false, 'sort_order' => 1],
                ],
                'amenities' => ['Wi-Fi', 'Кондиционер', 'Телевизор', 'Кухня'],
            ],
            [
                'title' => 'Студия с балконом в Москве',
                'address' => 'ул. Тверская, 10',
                'city' => 'Москва',
                'price_per_night' => 3500,
                'max_guests' => 2,
                'beds' => 1,
                'description' => 'Компактная студия в самом центре столицы. Идеально для пары.',
                'photos' => [
                    ['path' => 'storage/properties/demo3.jpg', 'is_cover' => true, 'sort_order' => 0],
                ],
                'amenities' => ['Wi-Fi', 'Кондиционер', 'Балкон'],
            ],
            [
                'title' => 'Просторная квартира в Санкт-Петербурге',
                'address' => 'Невский проспект, 28',
                'city' => 'Санкт-Петербург',
                'price_per_night' => 5500,
                'max_guests' => 6,
                'beds' => 3,
                'description' => 'Просторная трехкомнатная квартира в историческом центре. Рядом все достопримечательности.',
                'photos' => [
                    ['path' => 'storage/properties/demo4.jpg', 'is_cover' => true, 'sort_order' => 0],
                    ['path' => 'storage/properties/demo5.jpg', 'is_cover' => false, 'sort_order' => 1],
                    ['path' => 'storage/properties/demo6.jpg', 'is_cover' => false, 'sort_order' => 2],
                ],
                'amenities' => ['Wi-Fi', 'Кондиционер', 'Телевизор', 'Стиральная машина', 'Кухня', 'Балкон'],
            ],
            [
                'title' => 'Квартира у моря в Анапе',
                'address' => 'ул. Ленина, 5',
                'city' => 'Анапа',
                'price_per_night' => 4000,
                'max_guests' => 4,
                'beds' => 2,
                'description' => 'Уютная квартира в 5 минутах от пляжа. Есть все необходимое для комфортного отдыха.',
                'photos' => [
                    ['path' => 'storage/properties/demo7.jpg', 'is_cover' => true, 'sort_order' => 0],
                    ['path' => 'storage/properties/demo8.jpg', 'is_cover' => false, 'sort_order' => 1],
                ],
                'amenities' => ['Wi-Fi', 'Кондиционер', 'Телевизор', 'Парковка', 'Кухня'],
            ],
            [
                'title' => 'Современная квартира в Краснодаре',
                'address' => 'ул. Красная, 122',
                'city' => 'Краснодар',
                'price_per_night' => 3200,
                'max_guests' => 3,
                'beds' => 2,
                'description' => 'Современная квартира в новом доме. Все удобства, тихий район.',
                'photos' => [
                    ['path' => 'storage/properties/demo9.jpg', 'is_cover' => true, 'sort_order' => 0],
                ],
                'amenities' => ['Wi-Fi', 'Кондиционер', 'Стиральная машина', 'Парковка', 'Кухня'],
            ],
        ];

        foreach ($properties as $propertyData) {
            $amenities = $propertyData['amenities'];
            $photos = $propertyData['photos'];
            unset($propertyData['amenities'], $propertyData['photos']);

            $property = Property::create($propertyData);

            // Attach amenities (using direct insert to avoid timestamp issues)
            $amenityIds = Amenity::whereIn('name', $amenities)->pluck('id')->toArray();
            foreach ($amenityIds as $amenityId) {
                DB::table('property_amenities')->insert([
                    'property_id' => $property->id,
                    'amenity_id' => $amenityId,
                ]);
            }

            // Create photos
            foreach ($photos as $photoData) {
                PropertyPhoto::create([
                    'property_id' => $property->id,
                    ...$photoData,
                ]);
            }
        }
    }
}
