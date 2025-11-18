<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpareParts;

class SparePartsSeeder extends Seeder
{
    public function run(): void
    {
        $parts = [
            'Engine', 'Transmission', 'Brake Pads', 'Brake Discs', 'Brake Calipers',
            'Air Filter', 'Oil Filter', 'Fuel Filter', 'Spark Plugs', 'Battery',
            'Alternator', 'Starter Motor', 'Radiator', 'Water Pump', 'Thermostat',
            'Fan Belt', 'Timing Belt', 'Clutch Kit', 'Shock Absorbers', 'Struts',
            'Control Arms', 'Ball Joints', 'Tie Rod Ends', 'CV Joints', 'Wheel Bearings',
            'Headlights', 'Tail Lights', 'Fog Lights', 'Side Mirror', 'Windshield',
            'Windshield Wipers', 'Door Handle', 'Window Regulator', 'Door Lock',
            'Ignition Coil', 'Fuel Pump', 'Fuel Injectors', 'Oxygen Sensor', 'Catalytic Converter',
            'Exhaust Manifold', 'Muffler', 'Exhaust Pipe', 'Suspension Springs',
            'Sway Bar Links', 'Power Steering Pump', 'Steering Rack', 'Steering Column',
            'AC Compressor', 'AC Condenser', 'Blower Motor', 'Cabin Air Filter',
            'Tires', 'Wheels', 'Wheel Hub', 'Brake Master Cylinder', 'ABS Module',
            'ECU', 'TCM', 'BCM', 'Fuse Box', 'Relay', 'Sensors',
            'Throttle Body', 'EGR Valve', 'PCV Valve', 'Turbocharger', 'Intercooler',
            'Drive Shaft', 'Differential', 'Axle', 'Bumper', 'Hood',
            'Fender', 'Front Grille', 'Trunk Lid', 'Roof', 'Quarter Panel'
        ];

        foreach ($parts as $part) {
            SpareParts::create([
                'name' => $part,
                'category_id' => 1, // Default category
                'image' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
