<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class InventoryAdminController extends Controller
{
    public function index()
    {
        // Fetch inventories with related products and users, paginated
        $inventories = Inventory::with('product', 'user')->latest()->paginate(20);
        return view('admin.inventory.index', compact('inventories'));
    }

    public function create()
    {
        // Fetch all products for selection
        $products = Product::all();
        return view('admin.inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:adjustment,sale,purchase,return',
            'quantity_change' => 'required|integer',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Get the authenticated admin's ID
        $adminId = Auth::id();

        // Find the product and update its stock quantity
        $product = Product::findOrFail($validated['product_id']);
        $quantity_before = $product->stock_quantity;
        $quantity_after = $quantity_before + $validated['quantity_change'];

        // Update product stock quantity
        $product->stock_quantity = $quantity_after;
        $product->save();

        // Create inventory record with admin_id
        Inventory::create([
            'product_id' => $validated['product_id'],
            'type' => $validated['type'],
            'quantity_change' => $validated['quantity_change'],
            'quantity_before' => $quantity_before,
            'quantity_after' => $quantity_after,
            'reason' => $validated['reason'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'user_id' => Auth::id(),
            'store_id' => $product->store_id,
            'admin_id' => $adminId, // Use admin_id instead of user_id
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory updated successfully.');
    }

    public function show($id)
    {
        // Fetch and display a specific inventory record
        $inventory = Inventory::with('product')->findOrFail($id);
        return view('admin.inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        // Fetch all products for editing the inventory record
        $products = Product::all();
        return view('admin.inventory.edit', compact('inventory', 'products'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:adjustment,sale,purchase,return',
            'quantity_change' => 'required|integer',
            'reason' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Get the authenticated admin's ID
        $adminId = Auth::id();

        // Find the product and update the inventory record
        $product = Product::findOrFail($validated['product_id']);
        $quantity_before = $inventory->quantity_before;
        $quantity_after = $quantity_before + $validated['quantity_change'];

        // Update product stock quantity
        $product->stock_quantity = $quantity_after;
        $product->save();

        // Update the inventory record with admin_id
        $inventory->update([
            'product_id' => $validated['product_id'],
            'type' => $validated['type'],
            'quantity_change' => $validated['quantity_change'],
            'quantity_before' => $quantity_before,
            'quantity_after' => $quantity_after,
            'reason' => $validated['reason'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'admin_id' => $adminId, // Use admin_id instead of user_id
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory record updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        // Delete the inventory record
        $inventory->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory record deleted successfully.');
    }
}
