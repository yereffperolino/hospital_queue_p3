<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-800">User Management</h2>
                <p class="text-slate-500 text-sm mt-1">Manage system users and their roles</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add User
            </a>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-lg border border-slate-200 rounded-2xl">
        <table class="w-full text-left">
            <thead class="bg-gradient-to-r from-slate-100 to-slate-200 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-black text-slate-700 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                            {{ $user->role === 'doctor' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $user->role === 'receptionist' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $user->role === 'patient' ? 'bg-green-100 text-green-700' : '' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                            {{ $user->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $user->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end space-x-3">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</x-app-layout>
