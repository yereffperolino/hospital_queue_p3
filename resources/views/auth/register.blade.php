<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-black mb-2">Create Account</h2>
        <p class="text-black font-medium">Join the Hospital Queue Management System</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-bold text-black mb-2">
                Full Name
            </label>
            <input id="name" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-black placeholder-slate-500 transition" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-black mb-2">
                Email Address
            </label>
            <input id="email" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-black placeholder-slate-500 transition" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-bold text-black mb-2">
                Password
            </label>
            <input id="password" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-black placeholder-slate-500 transition" type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-bold text-black mb-2">
                Confirm Password
            </label>
            <input id="password_confirmation" class="block w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white text-black placeholder-slate-500 transition" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Create Account Button -->
        <div class="pt-4">
            <button type="submit" class="w-full flex items-center justify-center px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-black font-black text-lg rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Create Account
            </button>
        </div>

        <div class="text-center pt-4">
            <p class="text-black">
                Already have an account?
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-800 font-bold transition">
                    Sign in here
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
