<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-3xl text-slate-800">Reception Dashboard</h2>
                <p class="text-slate-500 text-sm mt-1">Monitor and manage patient queues across all departments</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <div class="text-sm font-medium text-slate-500">{{ now()->format('l, F j') }}</div>
                    <div class="text-lg font-black text-blue-600">{{ now()->format('g:i A') }}</div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Stats Overview -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Pending</p>
                    <p class="text-3xl font-black text-slate-800">{{ $stats['pending'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Waiting</p>
                    <p class="text-3xl font-black text-blue-600">{{ $stats['waiting'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-orange-600 uppercase tracking-wide">Processing</p>
                    <p class="text-3xl font-black text-orange-600">{{ $stats['processing'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-orange-50 rounded-lg">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 3m0 0H3m0 0h2m2 0h12a2 2 0 002-2V7a2 2 0 00-2-2h-6.586a1 1 0 01-.707.293l-5.414 5.414a1 1 0 01-.293.707V13a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-green-600 uppercase tracking-wide">Completed</p>
                    <p class="text-3xl font-black text-green-600">{{ $stats['completed'] ?? 0 }}</p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Department-wise Queue Cards -->
    <div class="space-y-6">
        <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            Queue by Department
        </h3>

        @foreach($departments as $department)
            @php
                $deptQueues = $queues->where('department_id', $department->id);
                $waitingCount = $deptQueues->where('status', 'waiting')->count();
                $processingCount = $deptQueues->where('status', 'processing')->count();
                $assignedCount = $deptQueues->where('status', 'assigned')->count();
                $totalActive = $waitingCount + $processingCount + $assignedCount;
            @endphp
            
            @if($totalActive > 0)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <!-- Department Header -->
                <div class="bg-slate-50 px-6 py-4 flex justify-between items-center border-b border-slate-200">
                    <div>
                        <h4 class="text-xl font-bold text-slate-800">{{ $department->department_name }}</h4>
                        <p class="text-slate-600 text-sm">{{ $totalActive }} active patient{{ $totalActive > 1 ? 's' : '' }}</p>
                    </div>
                    <div class="flex gap-2 flex-wrap">
                        @if($waitingCount > 0)
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold">{{ $waitingCount }} waiting</span>
                        @endif
                        @if($processingCount > 0)
                            <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">{{ $processingCount }} processing</span>
                        @endif
                        @if($assignedCount > 0)
                            <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-bold">{{ $assignedCount }} assigned</span>
                        @endif
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <!-- Waiting Patients -->
                    @if($waitingCount > 0)
                    <div>
                        <h5 class="text-sm font-bold text-slate-800 mb-3 uppercase tracking-wide">Waiting at Reception</h5>
                        @foreach($deptQueues->where('status', 'waiting') as $q)
                        <div class="flex items-center justify-between bg-blue-50 rounded-lg p-4 mb-2 last:mb-0 border border-blue-100">
                                <div class="flex items-center gap-4">
                                    <div class="bg-blue-100 text-blue-900 text-2xl font-black px-4 py-2 rounded-lg">#{{ $q->queue_number }}</div>
                                    <div>
                                        <p class="font-bold text-black text-lg">{{ $q->patient->name }}</p>
                                        <p class="text-sm text-slate-700">{{ $q->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            <form action="{{ route('queue.call', $q->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="processing">
                                <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Start Processing
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Processing Patients -->
                    @if($processingCount > 0)
                    <div>
                        <h5 class="text-sm font-bold text-orange-700 mb-3 uppercase tracking-wide">Currently Processing</h5>
                        @foreach($deptQueues->where('status', 'processing') as $q)
                        <div class="flex items-center justify-between bg-orange-50 rounded-lg p-4 mb-2 last:mb-0 border border-orange-100">
                            <div class="flex items-center gap-4">
                                <div class="bg-orange-100 text-orange-900 text-2xl font-black px-4 py-2 rounded-lg">#{{ $q->queue_number }}</div>
                                <div>
                                    <p class="font-bold text-black text-lg">{{ $q->patient->name }}</p>
                                    <p class="text-sm text-slate-700">Priority: {{ ucfirst($q->priority) }}</p>
                                </div>
                            </div>
                            <form action="{{ route('queue.call', $q->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="assigned">
                                <div class="flex items-center gap-2">
                                    <select name="doctor_id" class="border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-sm text-slate-800" required>
                                        <option value="">Select Doctor</option>
                                        @foreach($department->doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-purple-100 text-purple-800 px-4 py-2 rounded-lg font-bold hover:bg-purple-200 transition shadow-sm border border-purple-300 flex items-center gap-2">
                                        Assign
                                    </button>
                                </div>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Assigned Patients -->
                    @if($assignedCount > 0)
                    <div>
                        <h5 class="text-sm font-bold text-purple-700 mb-3 uppercase tracking-wide">Assigned to Doctors</h5>
                        @foreach($deptQueues->where('status', 'assigned') as $q)
                        <div class="flex items-center justify-between bg-purple-50 rounded-lg p-4 mb-2 last:mb-0 border border-purple-100">
                            <div class="flex items-center gap-4">
                                <div class="bg-purple-100 text-purple-900 text-2xl font-black px-4 py-2 rounded-lg">#{{ $q->queue_number }}</div>
                                <div>
                                    <p class="font-bold text-black text-lg">{{ $q->patient->name }}</p>
                                    @if($q->doctor)
                                        <p class="text-sm text-purple-800 font-semibold">Dr. {{ $q->doctor->user->name }}</p>
                                    @endif
                                </div>
                            </div>
                            <form action="{{ route('queue.call', $q->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="status" value="consulting">
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-700 transition shadow-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Start Consultation
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endif
        @endforeach
    </div>

    <!-- Empty State -->
    @if($departments->filter(fn($d) => $queues->where('department_id', $d->id)->whereIn('status', ['waiting', 'processing', 'assigned'])->count() > 0)->count() == 0)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="text-6xl mb-4 opacity-30">🏥</div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">All Clear!</h3>
            <p class="text-slate-500">No patients waiting in any department. Enjoy the quiet moment.</p>
        </div>
    @endif
</x-app-layout>
