<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $specialization
 * @property int $hospital_id
 */
class DoctorProfile extends Model
{
    protected $table = 'doctor_profiles';

    protected $fillable = [
        'user_id', 'date_of_birth', 'specialization',
        'qualifications', 'experience_years',
        'hospital_id', 'license_number'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'experience_years' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(HospitalProfile::class, 'hospital_id');
    }
}