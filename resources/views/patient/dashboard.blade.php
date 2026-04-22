<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-3xl text-slate-800">My Queue Status</h2>
                <p class="text-slate-500 text-sm mt-1">Track your current position and estimated wait time</p>
            </div>
            <a href="{{ route('queues.index') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Get New Ticket
            </a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Queue Card -->
        <div class="lg:col-span-2">
            @if($currentQueue)
                <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
                    <!-- Status Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-slate-700 text-sm font-medium uppercase tracking-wide">Current Status</p>
                                <h3 class="text-2xl font-bold text-slate-900 mt-1">{{ $currentQueue->department->department_name }}</h3>
                            </div>
                            <div class="text-right">
                                <p class="text-slate-700 text-sm uppercase tracking-wide">Queue Number</p>
                                <p class="text-5xl font-black text-slate-900 leading-none">#{{ $currentQueue->queue_number }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Status Badge -->
                        <div class="mb-6">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold
                                {{ $currentQueue->status === 'pending' ? 'bg-gray-100 text-gray-700 border border-gray-200' : '' }}
                                {{ $currentQueue->status === 'waiting' ? 'bg-blue-100 text-blue-700 border border-blue-200' : '' }}
                                {{ $currentQueue->status === 'called' ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' : '' }}
                                {{ $currentQueue->status === 'processing' ? 'bg-orange-100 text-orange-700 border border-orange-200' : '' }}
                                {{ $currentQueue->status === 'assigned' ? 'bg-purple-100 text-purple-700 border border-purple-200' : '' }}
                                {{ $currentQueue->status === 'consulting' ? 'bg-red-100 text-red-700 border border-red-200' : '' }}
                                {{ $currentQueue->status === 'completed' ? 'bg-green-100 text-green-700 border border-green-200' : '' }}">
                                @if($currentQueue->status === 'pending')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @elseif($currentQueue->status === 'waiting')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @elseif($currentQueue->status === 'assigned')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                @elseif($currentQueue->status === 'consulting')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @endif
                                {{ $currentQueue->getStatusLabel() }}
                            </span>
                        </div>

                        <!-- Action Card based on Status -->
                        @if($currentQueue->status === 'pending')
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
                                <div class="flex items-start gap-4">
                                    <div class="p-2 bg-blue-100 rounded-lg">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-blue-900 mb-1">You're in the queue!</h4>
                                        <p class="text-blue-700 text-sm mb-4">Your queue number has been reserved. Please check in at the reception when you arrive.</p>
                                        <form action="{{ route('queue.checkin', $currentQueue->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition shadow flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                I've Arrived - Check In
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @elseif($currentQueue->status === 'assigned' && $currentQueue->doctor)
                            <div class="bg-purple-50 border border-purple-200 rounded-xl p-6 mb-6">
                                <div class="flex items-start gap-4">
                                    <div class="p-2 bg-purple-100 rounded-lg">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-purple-900 mb-1">Doctor Assigned</h4>
                                        <p class="text-purple-700 text-sm mb-2">You will be seen by <strong>Dr. {{ $currentQueue->doctor->user->name }}</strong> shortly.</p>
                                        <div class="bg-white rounded-lg p-3 border border-purple-200">
                                            <p class="text-sm text-slate-600">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Please wait for the doctor to call your name.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @elseif($currentQueue->status === 'consulting')
                            <div class="bg-red-50 border border-red-200 rounded-xl p-6 mb-6">
                                <div class="flex items-start gap-4">
                                    <div class="p-2 bg-red-100 rounded-lg">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-red-900 mb-1">In Consultation</h4>
                                        <p class="text-red-700 text-sm">You are currently with the doctor. Your queue status will update once the consultation is complete.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Queue Info Cards -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-white rounded-lg p-4 border border-slate-200 shadow-sm">
                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Ticket</p>
                                <p class="text-2xl font-black text-blue-600">#{{ $currentQueue->queue_number }}</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-slate-200 shadow-sm">
                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Priority</p>
                                <p class="text-2xl font-black text-orange-600 capitalize">{{ $currentQueue->priority }}</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-slate-200 shadow-sm">
                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Joined</p>
                                <p class="text-lg font-bold text-slate-800">{{ \Carbon\Carbon::parse($currentQueue->created_at)->format('M d') }}</p>
                            </div>
                            <div class="bg-white rounded-lg p-4 border border-slate-200 shadow-sm">
                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Wait Time</p>
                                <p class="text-lg font-bold text-green-600">{{ $currentQueue->getEstimatedWaitTimeString() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Active Queue Card -->
                <div class="bg-white rounded-xl shadow-md border border-slate-200 p-12 text-center">
                    <div class="text-6xl mb-6 opacity-40">🎫</div>
                    <h3 class="text-2xl font-bold text-slate-700 mb-3">No Active Queue</h3>
                    <p class="text-slate-500 mb-6">You haven't joined any queue yet. Get your ticket to be seen.</p>
                    <a href="{{ route('queues.index') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Get Queue Ticket
                    </a>
                </div>
            @endif
        </div>

        <!-- Sidebar: History & Info -->
        <div class="space-y-6">
            <!-- Recent History Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Consultation History
                </h3>
                <div class="space-y-3">
                    @forelse($history ?? [] as $past)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-100 hover:bg-blue-50 transition">
                            <div>
                                <p class="font-bold text-slate-800">{{ $past->department->department_name }}</p>
                                <p class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($past->created_at)->format('M d, Y') }}</p>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold">Completed</span>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-sm text-slate-400 italic">No consultations yet</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Info Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Need Help?
                </h3>
                <ul class="text-sm text-blue-800 space-y-2">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Tap "Check In" when you arrive at reception</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Wait for your number to be called</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span>Refresh this page for updates</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
