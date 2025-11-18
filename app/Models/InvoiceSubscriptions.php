<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSubscriptions extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'type',
        'start_date',
        'end_date',
        'amount',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }
}
