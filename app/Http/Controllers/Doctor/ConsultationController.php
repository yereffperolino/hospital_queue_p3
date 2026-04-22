<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Queue;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Show doctor dashboard with queued patients
     */
    public function index()
    {
        $doctor = auth()->user()->doctor;

        if (! $doctor) {
            return redirect('/')->with('error', 'Doctor profile not found. Please contact admin.');
        }

        $deptId = $doctor->department_id;
        $queues = Queue::where('department_id', $deptId)
            ->where('status', 'consulting')
            ->with(['patient', 'department'])
            ->get();

        return view('doctor.index', compact('queues'));
    }

    /**
     * Complete a consultation and update queue status
     */
    public function complete(Request $request, $queueId)
    {
        $validated = $request->validate([
            'diagnosis' => 'required|string|min:5',
            'notes' => 'nullable|string',
        ]);

        $queue = Queue::findOrFail($queueId);

        Consultation::create([
            'patient_id' => $queue->patient_id,
            'doctor_id' => auth()->user()->doctor->id,
            'diagnosis' => $validated['diagnosis'],
            'notes' => $validated['notes'] ?? null,
            'consultation_date' => today(),
        ]);

        $queue->update(['status' => 'completed']);

        return redirect()->route('doctor.dashboard')->with('success', 'Consultation completed');
    }

    /**
     * Store method alias for route compatibility
     */
    public function store(Request $request)
    {
        return $this->complete($request, $request->queue_id);
    }
}
