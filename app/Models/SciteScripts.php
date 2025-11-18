<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SciteScripts extends Model
{
    use HasFactory;
    protected $table = 'site_scripts';
    protected $fillable = [
        'type',
        'script_content',
        'status',
    ];
}
