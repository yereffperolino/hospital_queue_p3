<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-800">Hospital Queue Management System</h2>
                <p class="text-slate-500 text-sm mt-1">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-slate-500">{{ now()->format('l, F j, Y') }}</p>
                <p class="text-lg font-black text-blue-600">{{ now()->format('g:i A') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions Card -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-800">Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }}!</h3>
                        <p class="text-slate-600">Ready to manage your healthcare tasks efficiently.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if(Auth::user()->role === 'patient')
                        <a href="{{ route('queues.index') }}" class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:shadow-md hover:border-blue-300 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">Get Queue Ticket</p>
                                    <p class="text-sm text-slate-500">Join a department queue</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('patient.dashboard') }}" class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:shadow-md hover:border-green-300 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-green-100 rounded-lg group-hover:bg-green-200 transition">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">My Dashboard</p>
                                    <p class="text-sm text-slate-500">View queue status</p>
                                </div>
                            </div>
                        </a>
                    @elseif(Auth::user()->role === 'doctor')
                        <a href="{{ route('doctor.dashboard') }}" class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:shadow-md hover:border-red-300 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-red-100 rounded-lg group-hover:bg-red-200 transition">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">Patient Consultations</p>
                                    <p class="text-sm text-slate-500">Manage your patients</p>
                                </div>
                            </div>
                        </a>
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-slate-100 rounded-lg">
                                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">Today's Schedule</p>
                                    <p class="text-sm text-slate-500">View appointments</p>
                                </div>
                            </div>
                        </div>
                    @elseif(Auth::user()->role === 'receptionist')
                        <a href="{{ route('receptionist.dashboard') }}" class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:shadow-md hover:border-orange-300 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-orange-100 rounded-lg group-hover:bg-orange-200 transition">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">Queue Monitor</p>
                                    <p class="text-sm text-slate-500">Manage patient flow</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('queues.index') }}" class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:shadow-md hover:border-blue-300 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">New Patient</p>
                                    <p class="text-sm text-slate-500">Register queue ticket</p>
                                </div>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('admin.reports.index') }}" class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:shadow-md hover:border-purple-300 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">System Reports</p>
                                    <p class="text-sm text-slate-500">View analytics</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl p-4 shadow-sm border border-slate-200 hover:shadow-md hover:border-indigo-300 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-indigo-100 rounded-lg group-hover:bg-indigo-200 transition">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800">User Management</p>
                                    <p class="text-sm text-slate-500">Manage staff & patients</p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>

            <!-- System Status Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    System Status
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-black text-green-600">{{ \App\Models\Queue::where('status', 'completed')->whereDate('created_at', today())->count() }}</div>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Completed Today</p>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-blue-600">{{ \App\Models\Queue::whereIn('status', ['waiting', 'processing', 'assigned'])->count() }}</div>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Active Queues</p>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-orange-600">{{ \App\Models\Department::count() }}</div>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Departments</p>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-purple-600">{{ \App\Models\User::where('role', 'doctor')->count() }}</div>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">Doctors</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-white text-xl font-black">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <h4 class="font-bold text-slate-800">{{ Auth::user()->name }}</h4>
                    <p class="text-sm text-slate-500 capitalize">{{ Auth::user()->role }}</p>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl p-6 border border-slate-200">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Quick Stats</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-600">Total Patients</span>
                        <span class="font-bold text-slate-800">{{ \App\Models\User::where('role', 'patient')->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-600">Active Staff</span>
                        <span class="font-bold text-slate-800">{{ \App\Models\User::whereIn('role', ['doctor', 'receptionist'])->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-600">Avg Wait Time</span>
                        <span class="font-bold text-green-600">~15 min</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Recent Activity
                </h3>
                <div class="space-y-3">
                    @foreach(\App\Models\Queue::latest()->take(3) as $queue)
                        <div class="flex items-center gap-3 p-2 rounded-lg bg-slate-50">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-slate-800">{{ $queue->patient->user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $queue->department->department_name }} • {{ $queue->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                    @if(\App\Models\Queue::count() == 0)
                        <p class="text-sm text-slate-400 italic">No recent activity</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
