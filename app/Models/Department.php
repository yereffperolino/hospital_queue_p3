<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name', 'description'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all doctors in this department
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Get all queues for this department
     */
    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

    /**
     * Get today's queues for this department
     */
    public function todayQueues()
    {
        return $this->queues()
                    ->whereDate('queue_date', today())
                    ->orderBy('queue_number')
                    ->get();
    }

    /**
     * Get today's pending count
     */
    public function pendingCount()
    {
        return $this->todayQueues()->where('status', 'pending')->count();
    }

    /**
     * Get today's called count
     */
    public function calledCount()
    {
        return $this->todayQueues()->where('status', 'called')->count();
    }

    /**
     * Get today's completed count
     */
    public function completedCount()
    {
        return $this->todayQueues()->where('status', 'completed')->count();
    }

    /**
     * Get active doctors count
     */
    public function activeDoctorsCount()
    {
        return $this->doctors()->count();
    }
}