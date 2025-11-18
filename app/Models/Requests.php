<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'city_id',
        'name',
        'business_name',
        'email',
        'whatsapp',
        'status',
    ];

    public static function whatsappExists($number)
    {
        return self::where('whatsapp', $number)->exists();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function supplier()
    {
        return $this->hasOne(Suppliers::class, 'request_id');
    }
}
