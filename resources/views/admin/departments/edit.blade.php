<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800">Edit Clinic</h2>
    </x-slot>

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-200 max-w-2xl">
        <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <x-input-label for="department_name" value="Clinic Name" />
                    <x-text-input id="department_name" name="department_name" class="block mt-1 w-full" 
                        :value="old('department_name', $department->department_name)" required autofocus />
                    <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" value="Description (Optional)" />
                    <textarea id="description" name="description" rows="3" 
                        class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $department->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-slate-200">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                        Update Clinic
                    </button>
                    <a href="{{ route('admin.departments.index') }}" class="text-slate-600 hover:text-slate-800 font-semibold">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
