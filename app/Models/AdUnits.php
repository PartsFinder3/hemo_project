<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdUnits extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'slot_id',
        'client_id',
        'status',
    ];

    protected $table = 'ad_units';
}
