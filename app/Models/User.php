<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_type',
        'profile_photo_path',
    ];

    public function isAdmin(): bool
    {
        return $this->profile_type === 'admin';
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'user_id', 'id');
    }

    public function eventRegistrations(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_registrations', 'user_id', 'event_id')
            ->withPivot('registration_date', 'status_presence', 'id')
            ->using(EventRegistration::class) // Definindo a model intermediária
            ->withTimestamps();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_type' => 'string',
        ];
    }
}
