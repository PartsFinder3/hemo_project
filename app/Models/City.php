<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class City extends Model
{
    use HasFactory;

    public function domain(){
        return $this->belongsTo(Domain::class);
    }

    public function requests(){
        return $this->hasMany(Requests::class);
    }

    public function suppliers(){
        return $this->hasMany(Suppliers::class,'city_id');
    }
}
