<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SpareParts;
class SparePartSeo extends Model
{
    use HasFactory;
       protected $table="spare_part_seo";

      protected $fillable = [
        'content',
        'part_id',
    ];
   
}
