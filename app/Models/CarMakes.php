<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarMakes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    protected $table = 'car_makes';

    public function models(){
        return $this->hasMany(CarModels::class);
    }

    public function inquiries()
    {
        return $this->hasMany(BuyerInquiry::class, 'car_make_id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, 'car_make_id');
    }

    public function carAds()
    {
        return $this->hasMany(CarAds::class, 'car_make_id');
    }

    public function shops()
    {
        return $this->hasMany(ShopMakes::class);
    }
    public function seoContent()
{
    return $this->hasOne(SeoContentMake::class, 'make_id');
}
}
