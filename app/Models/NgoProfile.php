<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $registration_no
 */
class NgoProfile extends Model
{
    protected $table = 'ngo_profiles';

    protected $fillable = [
        'user_id', 'registration_no',
        'contact_email', 'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}