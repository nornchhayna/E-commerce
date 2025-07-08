<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use Illuminate\Support\Facades\Log;

class CouponAdminController extends Controller
{
    // Show list of coupons
    public function index()
    {
        // Get the admin's user ID
        $adminId = Auth::id();

        // Fetch coupons associated with the admin's store
        $coupons = Coupon::whereHas('store', function ($query) use ($adminId) {
            $query->where('admin_id', $adminId);
        })->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.coupons.index', compact('coupons'));
    }

    // Show form to create a new coupon
    public function create()
    {
        return view('admin.coupons.create');
    }

    // Show form to edit an existing coupon
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    // Store a new coupon
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:coupons,code|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['used_count'] = 0;

        // Retrieve the store associated with the admin
        $store = Store::where('admin_id', Auth::id())->first();

        if (!$store) {
            Log::error('No store found for this admin', ['admin_id' => Auth::id()]);
            return back()->withErrors(['store_id' => 'No store associated with your account. Please create one first.'])->withInput();
        }

        $data['store_id'] = $store->id;
        $data['admin_id'] = Auth::id(); // Set the admin_id directly

        // Create the coupon
        Coupon::create($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    // Update an existing coupon
    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'maximum_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'usage_limit_per_user' => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        $data['is_active'] = $request->has('is_active');

        // Ensure the store_id remains unchanged during updates
        $data['store_id'] = $coupon->store_id;

        // Update the coupon
        $coupon->update($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }
}
