<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-800">Reports Dashboard</h2>
                <p class="text-slate-500 text-sm mt-1">Overview of queue activity and consultations</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-slate-500">{{ now()->format('l, F j, Y') }}</p>
                <p class="text-lg font-black text-blue-600">{{ now()->format('g:i A') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <!-- Stats Cards Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card: Total Queues Today -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wide">Today</span>
                </div>
                <div class="text-4xl font-black text-slate-800">{{ $totalQueues ?? 0 }}</div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mt-1">Total Queues</div>
            </div>

            <!-- Card: In Progress -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-orange-100 to-orange-200 text-orange-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-orange-600 bg-orange-50 px-3 py-1 rounded-full uppercase tracking-wide">Active</span>
                </div>
                <div class="text-4xl font-black text-slate-800">{{ $inProgress ?? 0 }}</div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mt-1">In Progress</div>
            </div>

            <!-- Card: Completed -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-green-100 to-green-200 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full uppercase tracking-wide">Done</span>
                </div>
                <div class="text-4xl font-black text-slate-800">{{ $completed ?? 0 }}</div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mt-1">Completed</div>
            </div>

            <!-- Card: Departments -->
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-purple-100 to-purple-200 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-purple-600 bg-purple-50 px-3 py-1 rounded-full uppercase tracking-wide">Total</span>
                </div>
                <div class="text-4xl font-black text-slate-800">{{ $departmentsCount ?? 0 }}</div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wide mt-1">Departments</div>
            </div>
        </div>

        <!-- Consultation History Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-slate-50 to-slate-100 px-6 py-5 border-b border-slate-200">
                <h3 class="text-xl font-black text-slate-800 flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Consultation History
                </h3>
                <p class="text-slate-500 text-sm mt-1">All completed consultations with patient and doctor details</p>
            </div>
            <div class="p-6">
                @if(isset($history) && $history->count() > 0)
                <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-sm">
                    <table class="w-full text-left">
                        <thead class="bg-gradient-to-r from-slate-100 to-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Patient</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Doctor</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Diagnosis</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($history as $consultation)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-medium text-slate-800">
                                    {{ optional($consultation->patient)->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ optional($consultation->doctor)->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 max-w-md truncate" title="{{ $consultation->diagnosis ?? '' }}">
                                    {{ Str::limit($consultation->diagnosis ?? 'N/A', 60) }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $deptName = optional(optional(optional($consultation->patient)?->queues->first())?->department)->department_name;
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                        {{ $deptName ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    @if(isset($consultation->consultation_date))
                                        @php
                                            $date = is_string($consultation->consultation_date) 
                                                ? \Carbon\Carbon::parse($consultation->consultation_date) 
                                                : $consultation->consultation_date;
                                        @endphp
                                        {{ $date->format('M d, Y') }}
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-700 mb-1">No Data Available</h4>
                    <p class="text-slate-500 text-sm">Consultation history will appear here once doctors complete appointments.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Additional Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-blue-800 mb-1">Understanding the Metrics</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li><strong>Total Queues</strong> – All patients who joined a queue today</li>
                        <li><strong>In Progress</strong> – Patients currently in any active stage (pending, waiting, called, processing, assigned, consulting)</li>
                        <li><strong>Completed</strong> – Consultations finished with diagnosis recorded</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
