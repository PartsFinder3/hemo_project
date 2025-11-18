<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $table = 'domains';
    protected $fillable = [
        'name',
        'domain_url',
        'about',
    ];

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function blogs(){
        return $this->hasMany(Blogs::class);
    }

    public function companyData()
    {
        return $this->hasOne(CompanyData::class,'domain_id');
    }

    public function metaTags(){
        return $this->hasOne(MetaTags::class,'domain_id');
    }

    public function partsMeta(){
        return $this->hasMany(PartsMeta::class,'domain_id');
    }

}
