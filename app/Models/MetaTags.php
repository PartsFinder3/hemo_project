<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTags extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'part_id',
        'description',
        'keywords',
        'domain_id'
    ];

    protected $table = 'meta_tags';

    public function domain(){
        return $this->belongsTo(Domain::class,'domain_id');
    }
}
