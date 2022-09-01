<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventRegistration extends Model
{
    protected $fillable = [
        'post_id',
        'max_attendees',
        'registration_start',
        'registration_end',
    ];

    protected $casts = [
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
    ];

    public function availableSeats(): null|int
    {
        if ($this->max_attendees === null) {
            return null;
        }

        return $this->max_attendees - $this->attendees()->count();
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(UserEventRegistration::class, 'event_registration_id', 'id');
    }

    // Delete all attendees when the event registration is deleted
    public function delete()
    {
        $this->attendees()->delete();
        parent::delete();
    }
}
