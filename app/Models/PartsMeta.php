<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartsMeta extends Model
{
    use HasFactory;

    protected $table = "parts_meta";

    protected $fillable = [
        'title',
        'description',
        'focus_keywords',
        'structure_data',
        'part_id',
        'domain_id'
    ];

    public function domain(){
        return $this->belongsTo(Domain::class,'domain_id');
    }

    public function part(){
        return $this->belongsTo(SpareParts::class,'part_id');
    }
}
