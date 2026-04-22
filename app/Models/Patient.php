<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id', 'name', 'birthdate', 'gender', 'address', 'contact_number'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function queues() {
        return $this->hasMany(Queue::class);
    }

    public function consultations() {
        return $this->hasMany(Consultation::class);
    }

    public function name()
    {
        return $this->user?->name ?? 'Unknown';
    }

    public function contactNumber()
    {
        return $this->contact_number;
    }
}