<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyers extends Model
{
    use HasFactory;
    // protected $fillable = ['whatsapp'];

    protected $fillable = [
        'whatsapp',
        'country_code',
        'city',
        'country',
        'domain'
    ];
    protected $table = 'buyers';

    public function inquiries()
    {
        return $this->hasMany(BuyerInquiry::class, 'buyer_id');
    }

    // public function invoices()
    // {
    //     return $this->hasMany(BuyerInvoices::class, 'buyer_id');
    // }
}
