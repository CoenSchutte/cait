<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEventRegistration extends Model
{
    protected $fillable = [
        'user_id',
        'event_registration_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function eventRegistration(): BelongsTo
    {
        return $this->belongsTo(EventRegistration::class, 'event_registration_id', 'id');
    }
}
