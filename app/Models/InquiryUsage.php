<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryUsage extends Model
{
    use HasFactory;

       protected $fillable = [
        'buyer_inquiry_id',
        'supplier_id',
    ];


    protected $table = 'inquiry_usuage';

    public function BuyerInquiry()
    {
        return $this->belongsTo(BuyerInquiry::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class);
    }
}
