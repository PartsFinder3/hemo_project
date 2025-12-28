<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityContent extends Model
{
    use HasFactory;
    protected $table="cities_content";

      protected $fillable = [
        'city_id',
        'content',
    ];
}
