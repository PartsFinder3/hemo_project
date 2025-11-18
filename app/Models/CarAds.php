<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAds extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'car_make_id',
        'car_model_id',
        'year_id',
        'fuel_id',
        'engine_size_id',
        'vin_number',
        'trade_license_number',
        'title',
        'description',
        'images',
        'is_approved',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($CarAd) {
            if (empty($CarAd->engine_size_id)) {
                $CarAd->engine_size_id = 999;
            }
            if (empty($CarAd->fuel_id)) {
                $CarAd->fuel_id = 999;
            }
        });
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    protected $table = 'car_ads';

    public function shop()
    {
        return $this->belongsTo(Shops::class, 'shop_id');
    }

    public function carMake()
    {
        return $this->belongsTo(CarMakes::class, 'car_make_id');
    }

    public function carModel()
    {
        return $this->belongsTo(CarModels::class, 'car_model_id');
    }

    public function year()
    {
        return $this->belongsTo(Years::class, 'year_id');
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class, 'fuel_id');
    }

    public function engineSize()
    {
        return $this->belongsTo(EngineSize::class, 'engine_size_id');
    }
}
