<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    use HasFactory;
    protected $fillable = [
        'domain_id',
        'about_us',
        'terms_conditions',
        'privacy_policy',
    ];
    protected $table = 'company_data';

    public function domain()
    {
        return $this->belongsTo(Domain::class,'domain_id');
    }
}
