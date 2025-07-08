<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Product $product)
    {
        return view('customer.reviews.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Ensure product exists
        if (is_null($product->id)) {
            return redirect()->back()->withErrors(['error' => 'Product ID is required.']);
        }

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('review_images', 'public');
            }
        }

        $product->reviews()->create([
            'user_id' => Auth::id(), // This assumes you're using the users table
            'rating' => $data['rating'],
            'product_id' => $product->id,
            'store_id' => $product->store_id,
            'title' => $data['title'],
            'comment' => $data['comment'] ?? null,
            'images' => json_encode($imagePaths), // Store images as JSON
            'is_verified' => true,
            'is_approved' => false,
        ]);

        return redirect()->route('orders.index')->with('success', 'Review submitted!');
    }
}
