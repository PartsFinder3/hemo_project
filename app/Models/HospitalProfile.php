<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $contact_email
 * @property string $website
 */
class HospitalProfile extends Model
{
    protected $table = 'hospital_profiles';

    protected $fillable = [
        'user_id', 'contact_email', 'contact_phone',
        'website', 'description'
    ];

    /**
     * Hospital belongs to one User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Hospital has many patients
     */
    public function patients(): HasMany
    {
        return $this->hasMany(PatientProfile::class, 'hospitals_id');
    }

    /**
     * Hospital has many doctors
     */
    public function doctors(): HasMany
    {
        return $this->hasMany(DoctorProfile::class, 'hospital_id');
    }
}