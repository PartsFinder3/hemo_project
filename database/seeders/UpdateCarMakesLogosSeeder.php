<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarMakes;

class UpdateCarMakesLogosSeeder extends Seeder
{
    public function run(): void
    {
        // Map car makes to their logo files
        $makesLogos = [
            'Toyota' => 'Frontend/assets/makes/1 (1).png',
            'Honda' => 'Frontend/assets/makes/1 (2).png',
            'Nissan' => 'Frontend/assets/makes/1 (3).png',
            'Ford' => 'Frontend/assets/makes/1 (4).png',
            'Chevrolet' => 'Frontend/assets/makes/1 (5).png',
            'BMW' => 'Frontend/assets/makes/1 (6).png',
            'Mercedes-Benz' => 'Frontend/assets/makes/1 (7).png',
            'Audi' => 'Frontend/assets/makes/1 (8).png',
            'Volkswagen' => 'Frontend/assets/makes/1 (9).png',
            'Hyundai' => 'Frontend/assets/makes/1 (10).png',
            'Kia' => 'Frontend/assets/makes/1 (11).png',
            'Mazda' => 'Frontend/assets/makes/1 (12).png',
            'Subaru' => 'Frontend/assets/makes/1 (13).png',
            'Lexus' => 'Frontend/assets/makes/1 (14).png',
            'Jeep' => 'Frontend/assets/makes/1 (15).png',
            'Ram' => 'Frontend/assets/makes/1 (16).png',
            'GMC' => 'Frontend/assets/makes/1 (17).png',
            'Dodge' => 'Frontend/assets/makes/1 (18).png',
            'Chrysler' => 'Frontend/assets/makes/1 (19).png',
            'Buick' => 'Frontend/assets/makes/1 (20).png',
            'Cadillac' => 'Frontend/assets/makes/1 (21).png',
            'Tesla' => 'Frontend/assets/makes/1 (22).png',
            'Volvo' => 'Frontend/assets/makes/1 (23).png',
            'Porsche' => 'Frontend/assets/makes/1 (24).png',
        ];

        foreach ($makesLogos as $makeName => $logoPath) {
            $make = CarMakes::where('name', $makeName)->first();
            if ($make) {
                $make->logo = $logoPath;
                $make->save();
                echo "Updated logo for: {$makeName}\n";
            }
        }
        
        echo "Car make logos updated successfully!\n";
    }
}
