<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-800">Manage Clinics</h2>
                <p class="text-slate-500 text-sm mt-1">Create, view, update, and delete hospital departments</p>
            </div>
            <a href="{{ route('admin.departments.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Clinic
            </a>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-slate-200">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b-2 border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Clinic Name</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Doctors</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($departments as $dept)
                <tr class="hover:bg-slate-50 transition group">
                    <td class="px-6 py-5 font-bold text-slate-800 text-base">{{ $dept->department_name }}</td>
                    <td class="px-6 py-5 text-sm text-slate-600 max-w-xs truncate">{{ $dept->description ?? '—' }}</td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-700">
                            {{ $dept->doctors_count ?? 0 }} doctors
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right flex justify-end gap-3">
                        <a href="{{ route('admin.departments.edit', $dept->id) }}" 
                           class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-slate-100 text-slate-700 hover:bg-blue-100 hover:text-blue-700 transition">
                           <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                           </svg>
                           Edit
                        </a>
                        <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this department? This action cannot be undone.');">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                   class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium bg-red-50 text-red-600 hover:bg-red-100 transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($departments->count() == 0)
        <div class="text-center py-12 bg-white rounded-2xl border border-slate-200">
            <div class="text-6xl mb-4">🏥</div>
            <h3 class="text-lg font-bold text-slate-700 mb-2">No Departments Yet</h3>
            <p class="text-slate-500 mb-4">Create your first clinic department to get started.</p>
            <a href="{{ route('admin.departments.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create First Department
            </a>
        </div>
    @endif
</x-app-layout>
