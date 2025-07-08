<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get customers based on user role
        if ($user->role === 'super_admin') {
            $customers = User::where('role', 'customer')
                ->with('parentAdmin')
                ->paginate(20);
        } else {
            $customers = User::where('parent_admin_id', $user->id)
                ->where('role', 'customer')
                ->paginate(20);
        }

        // Get all admins for transfer dropdown (super_admin only)
        $admins = $user->role === 'super_admin'
            ? User::where('role', 'admin')->get()
            : collect();

        return view('admin.customers.index', compact('customers', 'admins'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'is_approved' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'customer';

        // Auto-assign to current admin if admin is creating
        if (Auth::user()->role === 'admin') {
            $validated['parent_admin_id'] = Auth::id();
        }

        User::create($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show($id)
    {
        $user = Auth::user();

        // Check access permission
        if ($user->role === 'admin') {
            $customer = User::where('id', $id)
                ->where('parent_admin_id', $user->id)
                ->where('role', 'customer')
                ->firstOrFail();
        } else {
            $customer = User::where('id', $id)
                ->where('role', 'customer')
                ->firstOrFail();
        }

        return view('admin.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $user = Auth::user();

        // Check access permission
        if ($user->role === 'admin') {
            $customer = User::where('id', $id)
                ->where('parent_admin_id', $user->id)
                ->where('role', 'customer')
                ->firstOrFail();
        } else {
            $customer = User::where('id', $id)
                ->where('role', 'customer')
                ->firstOrFail();
        }

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Check access permission
        if ($user->role === 'admin') {
            $customer = User::where('id', $id)
                ->where('parent_admin_id', $user->id)
                ->where('role', 'customer')
                ->firstOrFail();
        } else {
            $customer = User::where('id', $id)
                ->where('role', 'customer')
                ->firstOrFail();
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($customer->id)],
            'password' => 'nullable|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'is_approved' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $customer->update($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        // Check access permission
        if ($user->role === 'admin') {
            $customer = User::where('id', $id)
                ->where('parent_admin_id', $user->id)
                ->where('role', 'customer')
                ->firstOrFail();
        } else {
            $customer = User::where('id', $id)
                ->where('role', 'customer')
                ->firstOrFail();
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    public function approve($id)
    {
        $user = Auth::user();

        // Check access permission
        if ($user->role === 'admin') {
            $customer = User::where('id', $id)
                ->where('parent_admin_id', $user->id)
                ->where('role', 'customer')
                ->firstOrFail();
        } else {
            $customer = User::where('id', $id)
                ->where('role', 'customer')
                ->firstOrFail();
        }

        $customer->update([
            'is_approved' => !$customer->is_approved,
            'approved_at' => $customer->is_approved ? null : now()
        ]);

        $status = $customer->is_approved ? 'approved' : 'unapproved';
        return back()->with('success', "Customer {$status} successfully.");
    }

    public function toggleStatus($id)
    {
        $user = Auth::user();

        // Check access permission
        if ($user->role === 'admin') {
            $customer = User::where('id', $id)
                ->where('parent_admin_id', $user->id)
                ->where('role', 'customer')
                ->firstOrFail();
        } else {
            $customer = User::where('id', $id)
                ->where('role', 'customer')
                ->firstOrFail();
        }

        $customer->update(['is_active' => !$customer->is_active]);

        $status = $customer->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Customer {$status} successfully.");
    }

    public function transfer(Request $request, $id)
    {
        // Only super_admin can transfer customers
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Only super admins can transfer customers.');
        }

        $validated = $request->validate([
            'new_admin_id' => 'required|exists:users,id',
        ]);

        // Verify the new admin is actually an admin
        $newAdmin = User::where('id', $validated['new_admin_id'])
            ->where('role', 'admin')
            ->firstOrFail();

        $customer = User::where('id', $id)
            ->where('role', 'customer')
            ->firstOrFail();

        $customer->update(['parent_admin_id' => $newAdmin->id]);

        return back()->with('success', "Customer transferred to {$newAdmin->name} successfully.");
    }

    public function bulkApprove(Request $request)
    {
        $validated = $request->validate([
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:users,id',
        ]);

        $user = Auth::user();
        $query = User::whereIn('id', $validated['customer_ids'])
            ->where('role', 'customer');

        // Restrict to admin's customers if not super_admin
        if ($user->role === 'admin') {
            $query->where('parent_admin_id', $user->id);
        }

        $updated = $query->update([
            'is_approved' => true,
            'approved_at' => now()
        ]);

        return back()->with('success', "{$updated} customers approved successfully.");
    }

    public function bulkTransfer(Request $request)
    {
        // Only super_admin can bulk transfer
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Only super admins can transfer customers.');
        }

        $validated = $request->validate([
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:users,id',
            'new_admin_id' => 'required|exists:users,id',
        ]);

        // Verify the new admin is actually an admin
        $newAdmin = User::where('id', $validated['new_admin_id'])
            ->where('role', 'admin')
            ->firstOrFail();

        $updated = User::whereIn('id', $validated['customer_ids'])
            ->where('role', 'customer')
            ->update(['parent_admin_id' => $newAdmin->id]);

        return back()->with('success', "{$updated} customers transferred to {$newAdmin->name} successfully.");
    }
}
