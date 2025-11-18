<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModels extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'car_make_id',   // ✅ allow mass assignment

    ];

    protected $table = 'car_models';
    public function makes(){
        return $this->belongsTo(CarMakes::class,'car_make_id');
    }

    public function varients(){
        return $this->hasMany(CarVarients::class);
    }

    public function inquiries()
    {
        return $this->hasMany(BuyerInquiry::class, 'car_model_id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, 'car_model_id');
    }

    public function carAds()
    {
        return $this->hasMany(CarAds::class, 'car_model_id');
    }
}
