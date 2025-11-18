<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Suppliers extends Authenticatable
{
    use HasFactory;
    protected $table = 'suppliers';

    public function latestSubscription()
    {
        return $this->hasOne(\App\Models\Inquiries::class, 'supplier_id')
            ->latest('end_date');
    }

    // public function getIsActiveAttribute()
    // {
    //     $sub = $this->latestSubscription;

    //     if (!$sub) return false;

    //     $today = now()->toDateString();

    //     $withinDate = $today >= $sub->start_date && $today <= $sub->end_date;

    //     $hasInquiriesLeft = is_null($sub->inquiries_limit) || ($sub->used_inquiries < $sub->inquiries_limit);

    //     return $withinDate && $hasInquiriesLeft;
    // }


    public function request()
    {
        return $this->belongsTo(Requests::class, 'request_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'supplier_id');
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiries::class, 'supplier_id');
    }

    public function shop()
    {
        return $this->hasOne(Shops::class, 'supplier_id');
    }

    public function inquiryUsages()
    {
        return $this->hasMany(InquiryUsage::class, 'supplier_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoices::class, 'supplier_id');
    }
}
