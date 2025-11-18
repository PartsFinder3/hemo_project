<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'description',
        'address',
        'cover',
        'profile_image',
    ];

    protected $table = 'shop_profile';

    public function shop()
    {
        return $this->belongsTo(Shops::class, 'shop_id');
    }
}
