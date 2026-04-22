<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Department;
use App\Models\Queue;

class ReportController extends Controller
{
    public function index()
    {
        $totalQueues = Queue::whereDate('created_at', today())->count();
        $completed = Queue::where('status', 'completed')->count();
        $inProgress = Queue::whereIn('status', ['pending', 'waiting', 'called', 'processing', 'assigned', 'consulting'])->count();
        $history = Consultation::with(['patient', 'doctor', 'patient.queues.department'])->get();
        $departmentsCount = Department::count();

        return view('admin.reports', compact('totalQueues', 'completed', 'inProgress', 'history', 'departmentsCount'));
    }
}
