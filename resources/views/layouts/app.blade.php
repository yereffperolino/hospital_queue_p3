<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'HQMS') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50">
        <div class="min-h-screen">
            @include('layouts.navigation')
            @isset($header)
                <header class="bg-white shadow-sm border-b border-slate-200">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="font-black text-xl text-slate-800">HQMS</span>
                            </div>
                            <div class="text-sm text-slate-500">
                                Hospital Queue Management System
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <main class="py-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
