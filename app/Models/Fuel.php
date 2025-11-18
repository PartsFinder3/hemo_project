<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    use HasFactory;

    protected $table = 'fuel';

    public function varients(){
        return $this->hasMany(CarVarients::class);
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, 'fuel_id');
    }

    public function carAds()
    {
        return $this->hasMany(CarAds::class, 'fuel_id');
    }

}
