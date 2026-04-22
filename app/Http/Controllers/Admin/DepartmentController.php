<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|unique:departments|max:255',
            'description' => 'nullable'
        ]);

        Department::create($request->all());
        return redirect()->route('admin.departments.index')->with('success', 'Department created!');
    }

    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department_name' => 'required|max:255|unique:departments,department_name,' . $department->id,
        ]);

        $department->update($request->all());
        return redirect()->route('admin.departments.index')->with('success', 'Department updated!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'Department deleted!');
    }
}