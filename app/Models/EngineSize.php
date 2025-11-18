<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineSize extends Model
{
    use HasFactory;
    protected $table = 'engine_size';

    public function varients(){
        return $this->hasMany(CarVarients::class);
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, 'engine_size_id');
    }

    public function carAds()
    {
        return $this->hasMany(CarAds::class, 'engine_size_id');
    }
}
