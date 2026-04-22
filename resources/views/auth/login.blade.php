<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-black mb-2">Welcome Back</h2>
        <p class="text-black font-medium">Sign in to your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-black mb-2">
                Email Address
            </label>
            <input id="email" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-black placeholder-slate-500 transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-bold text-black mb-2">
                Password
            </label>
            <input id="password" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-black placeholder-slate-500 transition" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-0" name="remember">
                <span class="ms-2 text-sm font-medium text-black">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-800 font-bold transition" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Sign In Button -->
        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-black font-black text-lg rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Sign In
            </button>
        </div>

        @if (Route::has('register'))
            <div class="text-center pt-4">
                <p class="text-black">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-bold transition">
                        Create one here
                    </a>
                </p>
            </div>
        @endif
    </form>
</x-guest-layout>
