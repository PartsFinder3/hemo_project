<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarMakes;

class CarMakesSeeder extends Seeder
{
    public function run(): void
    {
        $makes = [
            'Toyota', 'Honda', 'Nissan', 'Ford', 'Chevrolet',
            'BMW', 'Mercedes-Benz', 'Audi', 'Volkswagen', 'Hyundai',
            'Kia', 'Mazda', 'Subaru', 'Lexus', 'Jeep',
            'Ram', 'GMC', 'Dodge', 'Chrysler', 'Buick',
            'Cadillac', 'Tesla', 'Volvo', 'Porsche', 'Land Rover',
            'Jaguar', 'Mitsubishi', 'Infiniti', 'Acura', 'Genesis'
        ];

        foreach ($makes as $make) {
            CarMakes::create([
                'name' => $make,
                'slug' => \Illuminate\Support\Str::slug($make),
                'logo' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
