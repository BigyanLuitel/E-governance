<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'citizenship_number',
        'address',
        'ward_office_id',


    ];

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
        ];
    }
    public function wardOffice()
    {
        return $this->belongsTo(WardOffice::class);
    }

    public function documentRequests()
    {
        return $this->hasMany(DocumentRequest::class, 'citizen_id');
    }

    public function assignedRequests()
    {
        return $this->hasMany(DocumentRequest::class, 'officer_id');
    }
    public function isCitizen(): bool
    {
        return $this->role === 'citizen';
    }

    public function isOfficer(): bool
    {
        return $this->role === 'officer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}

