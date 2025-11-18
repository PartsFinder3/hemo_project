<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Years extends Model
{
    use HasFactory;

    public function inquiries()
    {
        return $this->hasMany(BuyerInquiry::class, 'year_id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, 'year_id');
    }

    public function carAds()
    {
        return $this->hasMany(CarAds::class, 'year_id');
    }
}
