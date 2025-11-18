<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'image_path',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'shop_gallery';

    public function shop()
    {
        return $this->belongsTo(Shops::class, 'shop_id');
    }
}
