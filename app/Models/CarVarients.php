<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarVarients extends Model
{
    use HasFactory;
    protected $table = 'car_variants';

    public function model(){
        return $this->belongsTo(CarModels::class,'car_model_id');
    }

    public function fuel(){
        return $this->belongsTo(Fuel::class,'fuel_id');
    }

    public function engineSize(){
        return $this->belongsTo(EngineSize::class,'engine_size_id');
    }
}
