<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Queue extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_id', 'department_id', 'queue_number', 'queue_date', 'status', 'priority'
    ];

    protected $dates = [
        'queue_date',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'queue_date' => 'date',
    ];

    /**
     * Get the patient for this queue entry
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor assigned to this queue entry
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * Get the department for this queue entry
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Scope to get today's queues
     */
    public function scopeToday($query)
    {
        return $query->whereDate('queue_date', today());
    }

    /**
     * Scope to filter by department
     */
    public function scopeForDepartment($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Check if queue is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if queue is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if queue is called
     */
    public function isCalled(): bool
    {
        return $this->status === 'called';
    }

    /**
     * Check if queue is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if queue is waiting (patient has arrived)
     */
    public function isWaiting(): bool
    {
        return $this->status === 'waiting';
    }

    /**
     * Check if queue is being processed by receptionist
     */
    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    /**
     * Check if queue is assigned to a doctor
     */
    public function isAssigned(): bool
    {
        return $this->status === 'assigned';
    }

    /**
     * Check if queue is currently consulting with doctor
     */
    public function isConsulting(): bool
    {
        return $this->status === 'consulting';
    }

    /**
     * Get status color for UI
     */
    public function getStatusColor(): string
    {
        return match($this->status) {
            'pending' => 'gray',
            'waiting' => 'blue',
            'called' => 'yellow',
            'processing' => 'orange',
            'assigned' => 'purple',
            'consulting' => 'red',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray'
        };
    }

    /**
     * Get status label for display
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'pending' => 'Booked Online',
            'waiting' => 'Waiting at Reception',
            'called' => 'Called by Receptionist',
            'processing' => 'Processing by Receptionist',
            'assigned' => 'Assigned to Doctor',
            'consulting' => 'With Doctor',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => 'Unknown'
        };
    }

    /**
     * Calculate estimated wait time in minutes
     */
    public function getEstimatedWaitTime(): int
    {
        $department = $this->department;
        $todayQueues = $department->todayQueues();

        // Count people ahead in queue
        $peopleAhead = 0;
        $foundCurrent = false;

        foreach ($todayQueues as $queue) {
            if ($queue->id === $this->id) {
                $foundCurrent = true;
                break;
            }

            // Count based on status priority
            if (in_array($queue->status, ['waiting', 'called', 'processing', 'assigned'])) {
                $peopleAhead++;
            }
        }

        // Average consultation time per patient (in minutes)
        $avgConsultationTime = 15; // Can be made configurable

        // Factor in current status
        $additionalTime = match($this->status) {
            'pending' => 5, // Time to arrive
            'waiting' => 3, // Quick check-in
            'called' => 2, // Being called
            'processing' => 10, // Paperwork time
            'assigned' => 5, // Waiting for doctor
            default => 0
        };

        return ($peopleAhead * $avgConsultationTime) + $additionalTime;
    }

    /**
     * Get estimated wait time as formatted string
     */
    public function getEstimatedWaitTimeString(): string
    {
        $minutes = $this->getEstimatedWaitTime();

        if ($minutes < 60) {
            return $minutes . ' minutes';
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($remainingMinutes === 0) {
            return $hours . ' hour' . ($hours > 1 ? 's' : '');
        }

        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ' . $remainingMinutes . ' minutes';
    }

    /**
     * Get queue position number
     */
    public function getQueuePosition(): int
    {
        $department = $this->department;
        $todayQueues = $department->todayQueues();

        $position = 1;
        foreach ($todayQueues as $queue) {
            if ($queue->id === $this->id) {
                return $position;
            }

            // Count active queues
            if (in_array($queue->status, ['waiting', 'called', 'processing', 'assigned', 'consulting'])) {
                $position++;
            }
        }

        return $position;
    }
}