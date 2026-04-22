<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    /**
     * Show department selection view
     */
    public function index()
    {
        $departments = Department::with('queues')->get();

        return view('queues.index', compact('departments'));
    }

    /**
     * Alias method for backward compatibility
     */
    public function selectDepartment()
    {
        return $this->index();
    }

    /**
     * Store patient in queue
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'priority' => 'required|in:normal,urgent,emergency',
        ]);

        $patient = Auth::user()->patient;

        if (! $patient) {
            return back()->with('error', 'Patient profile not found');
        }

        $latestQueue = Queue::where('department_id', $validated['department_id'])
            ->whereDate('queue_date', today())
            ->latest('queue_number')
            ->first();

        $nextNumber = $latestQueue ? $latestQueue->queue_number + 1 : 1;

        $queue = Queue::create([
            'patient_id' => $patient->id,
            'department_id' => $validated['department_id'],
            'queue_number' => $nextNumber,
            'queue_date' => today(),
            'status' => 'pending',
            'priority' => $validated['priority'],
        ]);

        return redirect()->route('patient.dashboard')
            ->with('success', 'You have joined the queue! Your number is '.$nextNumber);
    }

    /**
     * Patient check-in at reception
     */
    public function checkIn(Request $request, $id)
    {
        $queue = Queue::findOrFail($id);

        // Ensure only the patient can check in their own queue
        if ($queue->patient->user_id !== auth()->id()) {
            return back()->with('error', 'You can only check in your own queue.');
        }

        // Only allow check-in if status is pending
        if ($queue->status !== 'pending') {
            return back()->with('error', 'This queue cannot be checked in.');
        }

        $queue->update(['status' => 'waiting']);

        return back()->with('success', 'Successfully checked in! Please wait at reception.');
    }

    /**
     * Update queue status
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,waiting,called,processing,assigned,consulting,completed,cancelled',
            'doctor_id' => 'nullable|exists:doctors,id',
        ]);

        $queue = Queue::findOrFail($id);

        $queue->update([
            'status' => $validated['status'],
            'doctor_id' => $validated['doctor_id'] ?? $queue->doctor_id,
        ]);

        return back()->with('success', 'Queue updated to '.$validated['status']);
    }

    /**
     * Show receptionist monitoring dashboard
     */
    public function receptionistIndex()
    {
        $queues = Queue::with(['patient', 'patient.user', 'department', 'department.doctors', 'department.doctors.user', 'doctor', 'doctor.user'])
            ->whereDate('queue_date', today())
            ->orderBy('queue_number')
            ->get();

        $departments = Department::with('doctors', 'doctors.user')->get();

        $stats = [
            'pending' => $queues->where('status', 'pending')->count(),
            'waiting' => $queues->where('status', 'waiting')->count(),
            'called' => $queues->where('status', 'called')->count(),
            'processing' => $queues->where('status', 'processing')->count(),
            'assigned' => $queues->where('status', 'assigned')->count(),
            'consulting' => $queues->where('status', 'consulting')->count(),
            'completed' => $queues->where('status', 'completed')->count(),
            'cancelled' => $queues->where('status', 'cancelled')->count(),
        ];

        return view('receptionist.index', compact('queues', 'stats', 'departments'));
    }
}
