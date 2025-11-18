<?php

namespace App\Imports;

use App\Models\CarMakes;
use App\Models\CarModels;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class CarModelsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // First row = column headers (e.g. Toyota Models List, Nissan Models List…)
        $headers = $rows->shift()->toArray();

        foreach ($rows as $row) {
            foreach ($row as $colIndex => $modelName) {
                if (!$modelName) {
                    continue; // skip empty cells
                }

                $modelName = trim($modelName);

                // Clean header: remove "Models List" or similar text
                $makeName = trim(
                    str_ireplace(['models list', 'model list'], '', $headers[$colIndex])
                );

                // Find make by name
                $make = CarMakes::where('name', $makeName)->first();

                if ($make) {
                    CarModels::updateOrCreate(
                        [
                            'car_make_id' => $make->id,
                            'name'        => $modelName,
                        ],
                        [
                            'slug'        => Str::slug($modelName) ?: Str::random(8),
                        ]
                    );
                }
            }
        }
    }
}
