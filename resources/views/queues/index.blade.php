<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-800">Select a Department</h2>
                <p class="text-slate-500 text-sm mt-1">Choose the department you need and select your priority level</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-slate-500">Current Time</p>
                <p class="text-lg font-black text-blue-600">{{ now()->format('g:i A') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($departments as $dept)
        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 hover:border-blue-400 hover:shadow-xl transition-all duration-300 overflow-hidden group">
            <!-- Card Top Accent -->
            <div class="h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

            <form action="{{ route('queue.store') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="department_id" value="{{ $dept->id }}">

                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 group-hover:text-blue-600 transition">{{ $dept->department_name }}</h3>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $dept->description ?? 'Professional healthcare services' }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-3">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Priority Level
                    </label>
                    <select name="priority" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-slate-50 font-semibold text-slate-700 transition">
                        <option value="normal">🟢 Normal - Standard wait time</option>
                        <option value="urgent">🟠 Urgent - Priority service</option>
                        <option value="emergency">🔴 Emergency - Immediate attention</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-4 px-4 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition shadow-lg flex items-center justify-center gap-2 group-hover:gap-3 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Get Queue Ticket
                </button>
            </form>
        </div>
        @endforeach
    </div>

    <!-- Info Section -->
    <div class="mt-12 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
        <div class="text-center">
            <h3 class="text-xl font-bold text-slate-800 mb-4">How It Works</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 font-black text-lg">1</span>
                    </div>
                    <h4 class="font-bold text-slate-800 mb-1">Select Department</h4>
                    <p class="text-sm text-slate-500">Choose the healthcare service you need</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 font-black text-lg">2</span>
                    </div>
                    <h4 class="font-bold text-slate-800 mb-1">Get Queue Number</h4>
                    <p class="text-sm text-slate-500">Receive your ticket and estimated wait time</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-blue-600 font-black text-lg">3</span>
                    </div>
                    <h4 class="font-bold text-slate-800 mb-1">Wait & Monitor</h4>
                    <p class="text-sm text-slate-500">Track your progress in real-time</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
