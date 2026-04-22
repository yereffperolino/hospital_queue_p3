<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display all users
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a new user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => [
                'required',
                Rule::in(['admin', 'doctor', 'receptionist', 'patient'])
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => true
        ]);

        return back()->with('success', 'User created successfully');
    }

    /**
     * Show user edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => [
                'required',
                Rule::in(['admin', 'doctor', 'receptionist', 'patient'])
            ],
            'status' => 'boolean',
        ]);

        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}