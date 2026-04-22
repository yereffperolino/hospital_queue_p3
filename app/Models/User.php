<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean',
    ];

    /**
     * Check if user is a specific role
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    public function isReceptionist()
    {
        return $this->role === 'receptionist';
    }

    public function isPatient()
    {
        return $this->role === 'patient';
    }

    /**
     * Check if user is active
     */
    public function isActive()
    {
        return $this->status === true;
    }

    /**
     * Get the patient associated with user
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Get the doctor associated with user
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    /**
     * Scope to filter by role
     */
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope to filter active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}