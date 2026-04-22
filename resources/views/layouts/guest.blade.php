<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HQMS | Hospital Queue Management</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <!-- Logo -->
            <div class="mb-8">
                <div class="p-6 bg-white rounded-3xl shadow-2xl border border-white/20 backdrop-blur-sm">
                    <svg class="w-20 h-20 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h1 class="text-center text-2xl font-black text-white mt-4 drop-shadow-lg">HQMS</h1>
                <p class="text-center text-white/80 text-sm font-medium">Hospital Queue Management System</p>
            </div>

            <!-- Login/Register Card -->
            <div class="w-full sm:max-w-lg px-8 py-10 bg-gradient-to-br from-green-400 to-green-600 shadow-2xl overflow-hidden sm:rounded-3xl border border-green-300">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-white/90 drop-shadow-sm">
                <p>© 2026 Hospital Queue Management System</p>
            </div>
        </div>
    </body>
</html>
