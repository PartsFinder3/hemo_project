<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    public function getImagePathAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    protected $fillable = [
        'shop_id',
        'car_make_id',
        'car_model_id',
        'year_id',
        'fuel_id',
        'engine_size_id',
        'part_id',
        'condition',
        'title',
        'price',
        'warranty',
        'delivery',
        'description',
        'images',
    ];

    protected static function boot(){
        parent::boot();
        static::saving(function($ad){
            if(empty($ad->engine_size_id)){
                $ad->engine_size_id = 999;
            }
            if(empty($ad->fuel_id)){
                $ad->fuel_id = 999;
            }
        });
    }

    protected $casts = [
        'images' => 'array',
    ];

    protected $table = 'ads';

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

    public function part()
    {
        return $this->belongsTo(SpareParts::class, 'part_id');
    }
}
