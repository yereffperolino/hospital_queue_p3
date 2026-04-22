<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-800">Profile Settings</h2>
                <p class="text-slate-500 text-sm mt-1">Manage your account information and preferences</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-lg font-black">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <div class="max-w-xl">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Personal Information</h3>
                    <p class="text-slate-500 text-sm">Update your personal details and contact information</p>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <div class="max-w-xl">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Security Settings</h3>
                    <p class="text-slate-500 text-sm">Change your password and security preferences</p>
                </div>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-red-50 rounded-2xl border border-red-200 p-8">
            <div class="max-w-xl">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-red-800 mb-2">Danger Zone</h3>
                    <p class="text-red-600 text-sm">Irreversible and destructive actions</p>
                </div>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
