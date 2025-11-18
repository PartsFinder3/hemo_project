<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopParts extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'part_id'];
    protected $table = 'shop_parts';

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }

    public function part()
    {
        return $this->belongsTo(SpareParts::class);
    }
}
