<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'diagnosis',
        'notes',
        'consultation_date',
    ];

    protected $casts = [
        'consultation_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the patient associated with this consultation
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor who conducted the consultation
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
