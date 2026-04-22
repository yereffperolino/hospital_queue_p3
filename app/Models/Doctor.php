<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id', 'department_id', 'specialization', 'contact_number'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user associated with this doctor
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department this doctor belongs to
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get all consultations by this doctor
     */
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    /**
     * Get all queues assigned to this doctor
     */
    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

    /**
     * Get doctor's name from user relation
     */
    public function getName()
    {
        return $this->user?->name ?? 'Unknown Doctor';
    }

    /**
     * Get today's consultations
     */
    public function todayConsultations()
    {
        return $this->consultations()
                    ->whereDate('consultation_date', today())
                    ->get();
    }

    /**
     * Get today's queue
     */
    public function todayQueue()
    {
        return $this->queues()
                    ->whereDate('queue_date', today())
                    ->get();
    }
}