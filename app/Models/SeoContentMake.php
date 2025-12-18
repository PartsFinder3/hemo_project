<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoContentMake extends Model
{
    use HasFactory;
    protected $table="seo_contents_make";

      protected $fillable = [
        'seo_content_make',
        'make_id',
    ];
}
