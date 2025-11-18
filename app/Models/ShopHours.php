<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopHours extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    protected $table = 'shop_hours';

    public function shop()
    {
        return $this->belongsTo(Shops::class, 'shop_id');
    }
}
