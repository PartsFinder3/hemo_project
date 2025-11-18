<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Engine Parts',
            'Brake System',
            'Suspension',
            'Electrical',
            'Body Parts',
            'Interior',
            'Exterior',
            'Filters',
            'Lighting',
            'General Parts',
        ];

        foreach ($categories as $category) {
            DB::table('part_category')->insert([
                'name' => $category,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
