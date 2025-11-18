<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiries extends Model
{
    use HasFactory;

    protected $table = 'inquiries';

    protected $fillable = [
        'supplier_id',
        'start_date',
        'end_date',
        'inquiries_limit',
        'used_inquiries',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];


    protected static function booted()
    {
        static::creating(function ($subscription) {
            if (!$subscription->end_date) {
                $subscription->end_date = now()->addDays(30)->toDateString();
            }
        });
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }
}
