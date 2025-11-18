<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopMakes extends Model
{
    use HasFactory;
    protected $fillable = ['shop_id', 'make_id'];
    protected $table = 'shop_makes';

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }

    public function make()
    {
        return $this->belongsTo(CarMakes::class);
    }
}
