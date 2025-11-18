<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Years;

class YearsSeeder extends Seeder
{
    public function run(): void
    {
        $currentYear = date('Y');
        
        // Generate years from 1990 to current year + 1
        for ($year = 1990; $year <= $currentYear + 1; $year++) {
            Years::create([
                'year' => $year,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
