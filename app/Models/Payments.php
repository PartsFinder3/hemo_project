<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'supplier_id',
        'amount',
        'payment_date',
        'method',
        'image'
    ];

        protected $casts = [
        'payment_date' => 'datetime',
    ];


    public function supplier()
    {
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }
}
