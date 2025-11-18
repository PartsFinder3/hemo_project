<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpareParts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'oem_number',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(PartCategory::class, 'category_id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, 'part_id');
    }

    public function carAds()
    {
        return $this->hasMany(CarAds::class, 'part_id');
    }

    public function shops()
    {
        return $this->belongsToMany(Shops::class, 'shop_parts');
    }

    public function inquiries()
    {
        return $this->belongsToMany(BuyerInquiry::class, 'buyer_inquiry_part', 'part_id', 'buyer_inquiry_id');
    }

    public function partsMeta(){
        return $this->hasMany(PartsMeta::class,'part_id');
    }
}
