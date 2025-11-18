<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerInvoiceItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_invoice_id',
        'description',
        'quantity',
        'price',
    ];

    public function invoice()
    {
        return $this->belongsTo(BuyerInvoices::class, 'buyer_invoice_id');
    }
}
