<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800">Edit User</h2>
        </div>
    </x-slot>

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200 max-w-2xl">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <x-input-label for="name" value="Full Name" />
                    <x-text-input id="name" name="name" class="block mt-1 w-full" 
                        :value="old('name', $user->name)" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" value="Email Address" />
                    <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" 
                        :value="old('email', $user->email)" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="role" value="Role" />
                    <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="patient" {{ old('role', $user->role) == 'patient' ? 'selected' : '' }}>Patient</option>
                        <option value="doctor" {{ old('role', $user->role) == 'doctor' ? 'selected' : '' }}>Doctor</option>
                        <option value="receptionist" {{ old('role', $user->role) == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="status" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                            {{ old('status', $user->status) ? 'checked' : '' }} value="1">
                        <span class="ml-2 text-sm text-slate-600">Active</span>
                    </label>
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-200">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                        Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="text-slate-600 hover:text-slate-800 font-semibold">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
