<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            // Create 1-3 bookings per property
            $bookingCount = rand(1, 3);

            for ($i = 0; $i < $bookingCount; $i++) {
                $startDate = Carbon::now()->addDays(rand(1, 20));
                $nights = rand(2, 7);
                $endDate = (clone $startDate)->addDays($nights);

                Booking::create([
                    'property_id' => $property->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'status' => collect(['reserved', 'confirmed', 'blocked'])->random(),
                    'meta' => [],
                ]);
            }
        }
    }
}
