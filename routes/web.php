<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Doctor\ConsultationController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {


    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.reports.index');
            case 'doctor':
                return redirect()->route('doctor.dashboard');
            case 'receptionist':
                return redirect()->route('receptionist.dashboard');
            default:
                return redirect()->route('patient.dashboard');
        }
    })->name('dashboard');

    Route::prefix('patient')->name('patient.')->group(function () {
        Route::get('/home', [PatientController::class, 'index'])->name('dashboard');
    });

    Route::get('/queues/select', [QueueController::class, 'index'])->name('queues.index');
    Route::post('/queues/store', [QueueController::class, 'store'])->name('queue.store');
    Route::post('/queues/checkin/{id}', [QueueController::class, 'checkIn'])->name('queue.checkin');
    Route::post('/queues/call/{id}', [QueueController::class, 'updateStatus'])->name('queue.call');

    Route::get('/receptionist/monitor', [QueueController::class, 'receptionistIndex'])->name('receptionist.dashboard');

    Route::prefix('doctor')->name('doctor.')->middleware('auth')->group(function () {
        Route::get('/dashboard', [ConsultationController::class, 'index'])->name('dashboard');
        Route::post('/consultation/complete', [ConsultationController::class, 'store'])->name('consultation.store');
    });

    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
      
        Route::resource('departments', DepartmentController::class);
        
        Route::resource('users', UserController::class);
        
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';