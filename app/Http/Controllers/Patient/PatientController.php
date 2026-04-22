<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display patient dashboard with active queues
     */
    public function index()
    {
        // Ensure user is a patient
        if (! Auth::user()->isPatient()) {
            return redirect()->route('dashboard')->with('error', 'Access denied. You are not registered as a patient.');
        }

        $patient = Auth::user()->patient;

        if (! $patient) {
            // Create patient profile if not exists
            $patient = Auth::user()->patient()->create([
                'name' => Auth::user()->name,
                'birthdate' => null,
                'gender' => null,
                'address' => null,
                'contact_number' => null,
            ]);
        }

        $currentQueue = Queue::with(['department', 'doctor', 'doctor.user'])
            ->where('patient_id', $patient->id)
            ->whereNotIn('status', ['completed', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->first();

        $history = Queue::with(['department', 'doctor', 'doctor.user'])
            ->where('patient_id', $patient->id)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('patient.dashboard', compact('currentQueue', 'history'));
    }
}
