<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users
        $users = User::all(); // You can modify this to use pagination if needed

        // Pass the users to the view
        return view('users.index', compact('users'));
        // Fetch only admin users managed by the current super admin
        $admins = User::where('role', 'admin')->where('parent_admin_id', Auth::id())->get();
        // return view('users.index', compact('admins'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin',  // Only allow admin role
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->parent_admin_id = Auth::id(); // Link to the current super admin
        $user->is_active = true;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('users.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8',  // Allow password update if provided
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }
        $admin->is_active = $request->has('is_active');
        $admin->save();

        return redirect()->route('users.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('users.index')->with('success', 'Admin deleted successfully.');
    }
}
