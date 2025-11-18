<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'invoice_number',
        'payment_method',
        'payment_date',
        'remarks',
        'total_amount',
        'pdf_path',
    ];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(InvoiceSubscriptions::class, 'invoice_id');
    }
}
