<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-800">Doctor Panel</h2>
                <p class="text-slate-500 text-sm mt-1">Patients awaiting consultation in your department</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-slate-500">{{ now()->format('l, F j, Y') }}</p>
                <p class="text-lg font-black text-blue-600">{{ now()->format('g:i A') }}</p>
            </div>
        </div>
    </x-slot>

    @if($queues->count() > 0)
        <div class="space-y-6">
            @foreach($queues as $queue)
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden hover:shadow-xl transition-all duration-300">
                <!-- Patient Header -->
                <div class="bg-gradient-to-r from-red-50 to-red-100 border-b border-red-200 px-6 py-6 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-red-100 rounded-xl">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-red-700 text-sm font-bold uppercase tracking-wide">Now Consulting</p>
                            <h3 class="text-2xl font-black text-slate-900">{{ $queue->patient->user->name }}</h3>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-red-700 text-sm font-bold uppercase tracking-wide">Queue</p>
                        <p class="text-5xl font-black text-blue-700">#{{ $queue->queue_number }}</p>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Patient Info Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-5 border border-slate-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-500 uppercase tracking-wide font-bold">Department</p>
                            </div>
                            <p class="font-black text-slate-800 text-lg">{{ $queue->department->department_name }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-5 border border-slate-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-orange-100 rounded-lg">
                                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-500 uppercase tracking-wide font-bold">Priority</p>
                            </div>
                            <p class="font-black text-orange-600 text-lg capitalize">{{ $queue->priority }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-5 border border-slate-200 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-red-100 rounded-lg">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-500 uppercase tracking-wide font-bold">Status</p>
                            </div>
                            <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold uppercase">
                                Consulting
                            </span>
                        </div>
                    </div>

                    <!-- Consultation Form -->
                    <form action="{{ route('doctor.consultation.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="queue_id" value="{{ $queue->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="diagnosis" class="block text-sm font-bold text-slate-700 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Diagnosis
                                </label>
                                <textarea id="diagnosis" name="diagnosis" rows="4"
                                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-slate-800 placeholder-slate-400"
                                    placeholder="Enter primary diagnosis..." required autofocus>{{ old('diagnosis') }}</textarea>
                                <p class="text-xs text-slate-500 mt-1">Be specific and include relevant symptoms</p>
                            </div>

                            <div>
                                <label for="notes" class="block text-sm font-bold text-slate-700 mb-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Clinical Notes
                                </label>
                                <textarea id="notes" name="notes" rows="4"
                                    class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-slate-500 placeholder-slate-400"
                                    placeholder="Additional observations, prescriptions, recommendations...">{{ old('notes') }}</textarea>
                                <p class="text-xs text-slate-500 mt-1">Optional: medications, follow-up, etc.</p>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200">
                            <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition shadow-md flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Complete Consultation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-16 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 mb-6">
                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-700 mb-2">All Caught Up!</h3>
            <p class="text-slate-500 mb-8">No patients currently waiting for consultation. Check back later.</p>
            <a href="{{ route('doctor.dashboard') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 3m0 0H3m0 0h2m2 0h12a2 2 0 002-2V7a2 2 0 00-2-2h-6.586a1 1 0 01-.707.293l-5.414 5.414a1 1 0 01-.293.707V13a2 2 0 01-2 2z"></path>
                </svg>
                Refresh Status
            </a>
        </div>
    @endif
</x-app-layout>
