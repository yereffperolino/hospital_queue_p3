<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HQMS | Hospital Queue Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 antialiased font-sans">
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-blue-500 selection:text-white">
        
        <div class="absolute top-0 right-0 p-6 text-right z-10">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-600 hover:text-blue-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-blue-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-slate-600 hover:text-blue-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex flex-col items-center">
                <!-- Hospital Logo SVG -->
                <div class="mb-8">
                    <div class="p-4 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl shadow-lg">
                        <svg class="w-20 h-20 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-5xl font-black text-slate-800 text-center mb-4">
                    Hospital <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Queue</span> Management
                </h1>
                
                <p class="text-xl text-slate-500 text-center max-w-2xl mb-12 leading-relaxed">
                    A streamlined digital solution for patients, doctors, and staff. Get your queue number, monitor wait times, and manage consultations all in one place.
                </p>

                <!-- Feature Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 w-full max-w-4xl">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 hover:shadow-xl transition-all">
                        <div class="p-3 bg-blue-100 rounded-xl w-fit mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Easy Queue Registration</h3>
                        <p class="text-slate-500 text-sm">Get your queue ticket instantly from any device with our simple registration process.</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 hover:shadow-xl transition-all">
                        <div class="p-3 bg-green-100 rounded-xl w-fit mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Real-time Monitoring</h3>
                        <p class="text-slate-500 text-sm">Track your position in the queue and get estimated wait times with live updates.</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-slate-200 hover:shadow-xl transition-all">
                        <div class="p-3 bg-purple-100 rounded-xl w-fit mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Efficient Management</h3>
                        <p class="text-slate-500 text-sm">Streamlined workflow for healthcare staff to manage patient flow effectively.</p>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-bold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-bold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-slate-700 px-8 py-4 rounded-xl font-bold border-2 border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition shadow-lg flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Create Account
                        </a>
                    @endauth
                </div>

                <footer class="mt-16 text-center text-sm text-slate-400">
                    <p class="mt-1">© {{ date('Y') }} All rights reserved</p>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
