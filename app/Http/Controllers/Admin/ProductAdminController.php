<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use Illuminate\Support\Facades\Log;

class ProductAdminController extends Controller
{
    // Display the list of products
    public function index()
    {
        // Get the admin's user ID
        $adminId = Auth::id();

        // Fetch products associated with the admin's store
        $products = Product::whereHas('store', function ($query) use ($adminId) {
            $query->where('admin_id', $adminId);
        })->orderBy('created_at', direction: 'desc')->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    // Show form to create a new product
    public function create()
    {
        // Fetch categories from DB
        $categories = Category::all();

        // Pass categories to the view
        return view('admin.products.create', compact('categories'));
    }

    // Show form to edit an existing product
    public function edit(Product $product)
    {
        $product->load('categories'); // Load categories for the product
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'weight' => 'nullable|integer|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'track_inventory' => 'boolean',
            'stock_quantity' => 'required_if:track_inventory,true|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'stock_status' => 'required|in:in_stock,out_of_stock,backorder',
            'is_active' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'categories' => ['array'],
            'categories.*' => ['exists:categories,id'],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        try {
            return DB::transaction(function () use ($request, $validated) {
                $imagePaths = [];
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        try {
                            $path = $image->store('products', 'public');
                            $imagePaths[] = $path;
                        } catch (\Exception $e) {
                            throw new \Exception('Failed to upload image: ' . $e->getMessage());
                        }
                    }
                }

                // Retrieve the store associated with the admin
                $store = Store::where('admin_id', Auth::id())->first();

                if (!$store) {
                    Log::error('No store found for this admin', ['admin_id' => Auth::id()]);
                    return back()->withErrors(['store_id' => 'No store associated with your account. Please create one first.'])->withInput();
                }

                // Set boolean values based on checkbox presence
                $validated['is_active'] = $request->has('is_active');
                $validated['is_featured'] = $request->has('is_featured');
                $validated['track_inventory'] = $request->has('track_inventory');

                // Prepare data for creation
                $data = [
                    'name' => $validated['name'],
                    'slug' => Str::slug($validated['name']) . '-' . time(),
                    'description' => $validated['description'],
                    'short_description' => $validated['short_description'] ?? null,
                    'sku' => $validated['sku'],
                    'price' => $validated['price'],
                    'compare_price' => $validated['compare_price'] ?? null,
                    'cost_price' => $validated['cost_price'] ?? null,
                    'images' => json_encode($imagePaths), // Store images as JSON
                    'weight' => $validated['weight'] ?? null,
                    'dimensions' => json_encode([
                        'length' => $validated['length'] ?? null,
                        'width' => $validated['width'] ?? null,
                        'height' => $validated['height'] ?? null,
                    ]),
                    'track_inventory' => $validated['track_inventory'],
                    'stock_quantity' => $validated['stock_quantity'] ?? 0,
                    'low_stock_threshold' => $validated['low_stock_threshold'] ?? null,
                    'stock_status' => $validated['stock_status'],
                    'is_active' => $validated['is_active'],
                    'is_featured' => $validated['is_featured'],
                    'attributes' => json_encode([
                        'color' => $validated['color'] ?? null,
                        'size' => $validated['size'] ?? null,
                    ]),
                    'meta_title' => $validated['meta_title'] ?? null,
                    'meta_description' => $validated['meta_description'] ?? null,
                    'store_id' => $store->id, // Include store_id
                    'admin_id' => Auth::id(), // Set the admin_id directly
                ];

                // Create the product
                $product = Product::create($data);

                // Sync categories if provided
                if ($request->has('categories')) {
                    $product->categories()->sync($request->input('categories'));
                }

                return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
            });
        } catch (\Exception $e) {
            Log::error('Failed to create product', ['error' => $e->getMessage(), 'admin_id' => Auth::id()]);
            return back()->withErrors(['error' => 'Failed to create product: ' . $e->getMessage()])->withInput();
        }
    }

    // Update an existing product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'sku' => ['required', 'string', Rule::unique('products')->ignore($product->id)],
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array|max:5',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'weight' => 'nullable|integer|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'track_inventory' => 'sometimes|boolean',
            'stock_quantity' => 'required_if:track_inventory,true|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'stock_status' => 'required|in:in_stock,out_of_stock,backorder',
            'is_active' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'categories' => ['array'],
            'categories.*' => ['exists:categories,id'],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        try {
            return DB::transaction(function () use ($request, $validated, $product) {
                $imagePaths = [];
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        try {
                            $path = $image->store('products', 'public');
                            $imagePaths[] = $path;
                        } catch (\Exception $e) {
                            throw new \Exception('Failed to upload image: ' . $e->getMessage());
                        }
                    }
                }

                // Set boolean values based on checkbox presence
                $validated['is_active'] = $request->has('is_active');
                $validated['is_featured'] = $request->has('is_featured');
                $validated['track_inventory'] = $request->has('track_inventory');

                // Ensure the store_id remains unchanged during updates
                $validated['store_id'] = $product->store_id;

                // Update product
                $updateData = [
                    'name' => $validated['name'],
                    'slug' => $product->slug ?? Str::slug($validated['name']) . '-' . time(), // Preserve existing slug if set
                    'description' => $validated['description'],
                    'short_description' => $validated['short_description'] ?? null,
                    'sku' => $validated['sku'],
                    'price' => $validated['price'],
                    'compare_price' => $validated['compare_price'] ?? null,
                    'cost_price' => $validated['cost_price'] ?? null,
                    'weight' => $validated['weight'] ?? null,
                    'dimensions' => json_encode([
                        'length' => $validated['length'] ?? null,
                        'width' => $validated['width'] ?? null,
                        'height' => $validated['height'] ?? null,
                    ]),
                    'track_inventory' => $validated['track_inventory'],
                    'stock_quantity' => $validated['stock_quantity'] ?? 0,
                    'low_stock_threshold' => $validated['low_stock_threshold'] ?? null,
                    'stock_status' => $validated['stock_status'],
                    'is_active' => $validated['is_active'],
                    'is_featured' => $validated['is_featured'],
                    'attributes' => json_encode([
                        'color' => $validated['color'] ?? null,
                        'size' => $validated['size'] ?? null,
                    ]),
                    'meta_title' => $validated['meta_title'] ?? null,
                    'meta_description' => $validated['meta_description'] ?? null,
                    'store_id' => $validated['store_id'], // Maintain store_id
                ];

                if (!empty($imagePaths)) {
                    $updateData['images'] = json_encode($imagePaths);
                }

                $product->update($updateData);

                // Sync categories
                $product->categories()->sync($request->input('categories', []));

                return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
            });
        } catch (\Exception $e) {
            Log::error('Failed to update product', ['error' => $e->getMessage(), 'product_id' => $product->id]);
            return back()->withErrors(['error' => 'Failed to update product: ' . $e->getMessage()])->withInput();
        }
    }

    // Show details of a specific product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Delete an existing product
    public function destroy(Product $product)
    {
        try {


            if ($product->images) {
                $images = is_array($product->images) ? $product->images : json_decode($product->images, true);

                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete product', ['error' => $e->getMessage(), 'product_id' => $product->id]);
            return back()->withErrors(['error' => 'Failed to delete product: ' . $e->getMessage()]);
        }
    }
}
