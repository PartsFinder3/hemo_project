<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $disorder_type
 * @property int $hospitals_id
 */
class PatientProfile extends Model
{
    protected $table = 'patient_profiles';

    protected $fillable = [
        'user_id', 'disorder_type', 'severity',
        'date_of_birth', 'medical_history', 'hospitals_id'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(HospitalProfile::class, 'hospitals_id');
    }
}