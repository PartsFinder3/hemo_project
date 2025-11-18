<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shops extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'name',
    ];
    protected $table = 'shops';

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function profile()
    {
        return $this->hasOne(ShopProfile::class, 'shop_id');
    }

    public function ads()
    {
        return $this->hasMany(Ads::class, 'shop_id');
    }

    public function carAds()
    {
        return $this->hasMany(CarAds::class, 'shop_id');
    }

    public function parts()
    {
        return $this->hasMany(ShopParts::class,'shop_id');
    }

    public function makes()
    {
        return $this->hasMany(ShopMakes::class);
    }

    public function hours()
    {
        return $this->hasOne(ShopHours::class, 'shop_id');
    }

    public function gallery()
    {
        return $this->hasMany(ShopGallery::class, 'shop_id');
    }

    public function invoices()
    {
        return $this->hasMany(BuyerInvoices::class, 'shop_id');
    }
}
