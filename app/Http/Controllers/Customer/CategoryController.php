<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of active categories (nested).
     */
    public function index()
    {
        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();
        return view('customer.catalog.category', compact('categories'));
    }


    /**
     * Display the specified category and its products.
     *
     * @param  string $slug
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Load products or children if needed
        $products = $category->products()->where('is_active', true)->get();

        return view('customer.catalog.CategoryShow', compact('category', 'products'));
    }
}
