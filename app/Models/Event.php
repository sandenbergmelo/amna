<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'image_path'
    ];

    public function isUserSubscribed(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_registrations', 'event_id', 'user_id')
            ->withPivot('registration_date', 'status_presence', 'id')
            ->using(EventRegistration::class)
            ->withTimestamps();
    }
}
