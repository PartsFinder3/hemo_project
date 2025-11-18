<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerInquiry extends Model
{
    use HasFactory;

    protected $table = 'buyer_inquiries';

    protected $fillable = [
        'car_make_id',
        'car_model_id',
        'year_id',
        'buyer_id',
        'condition',
        'vin_num',
        'oem_num',
        'is_send'
    ];

    protected $attributes = [
        'is_send' => true,
    ];


    public function buyer()
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
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

    public function inquiryUsages()
    {
        return $this->hasMany(InquiryUsage::class, 'buyer_inquiry_id');
    }

    public function partsList()
    {
        return $this->belongsToMany(SpareParts::class, 'buyer_inquiry_part', 'buyer_inquiry_id', 'part_id');
    }
}
