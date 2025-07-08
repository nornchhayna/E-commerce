<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)
            ->with(['categories', 'reviews']);

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        $query = Product::query()->where('is_active', true);

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }



        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price');
                break;
            case 'price_high':
                $query->orderByDesc('price');
                break;
            case 'popular':
                $query->orderByDesc('views');
                break;
            default:
                $query->latest();
        }
        // this is when it have 1 2 3 4 5 6 7 page with ->
        // $products = $query->paginate(12);
        $products = Product::paginate(12);

        return view('customer.products.index', compact('products'));
    }

    public function featured()
    {
        $products = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with(['categories', 'reviews'])
            ->paginate(12);

        return view('customer.catalog.featured', compact('products'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->paginate(12);

        return view('customer.catalog.search', compact('products', 'query'));
    }
    public function show($slug, $id)
    {
        // Fetch the product by ID and check the slug
        $product = Product::where('id', $id)
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with(['categories', 'reviews'])
            ->firstOrFail();

        $product->increment('views');

        // Fetch related products
        $relatedProducts = Product::whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('customer.products.show', compact('product', 'relatedProducts'));
    }
}
