<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerInvoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'buyer_name',
        'buyer_phone',
        'buyer_address',
        'invoice_number',
        'invoice_date',
        'total_amount',
        'pdf_path'
    ];

    // public function buyer()
    // {
    //     return $this->belongsTo(Buyers::class,'buyer_id');
    // }

    public function shop()
    {
        return $this->belongsTo(Shops::class,'shop_id'  );
    }

    public function items()
    {
        return $this->hasMany(BuyerInvoiceItems::class,'buyer_invoice_id');
    }
}
