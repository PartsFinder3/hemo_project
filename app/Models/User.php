<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property int $role_id
 * @property bool $is_verified
 * @property bool $status
 * @property string $profile_image
 */
class User extends Authenticatable
{
      use HasApiTokens;
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role_id',
        'country', 'city', 'profile_image', 'gender',
        'is_verified', 'status','updated_by'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'status' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Role of the user (patient, doctor, etc.)
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    /**
     * One-to-one: User → Patient Profile
     */
    public function patientProfile(): HasOne
    {
        return $this->hasOne(PatientProfile::class, 'user_id');
    }

    /**
     * One-to-one: User → Doctor Profile
     */
    public function doctorProfile(): HasOne
    {
        return $this->hasOne(DoctorProfile::class, 'user_id');
    }

    /**
     * One-to-one: User → Hospital Profile
     */
    public function hospitalProfile(): HasOne
    {
        return $this->hasOne(HospitalProfile::class, 'user_id');
    }

    /**
     * One-to-one: User → NGO Profile
     */
    public function ngoProfile(): HasOne
    {
        return $this->hasOne(NgoProfile::class, 'user_id');
    }
}