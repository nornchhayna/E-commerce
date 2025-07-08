<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
class CategoryAdminController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }
    public function show($id)
    {
        $category = Category::with('parent')->findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }
    // app/Models/Category.php


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'parent_id' => 'nullable|exists:categories,id',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $user = Auth::user();
        $storeId = $user->store_id;

        if (!$storeId) {
            return redirect()->back()->with('error', 'You are not associated with a store.');
        }

        $slug = $request->slug ?? Str::slug($request->name);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('categories', 'public')
            : null;

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'store_id' => $storeId,
            'admin_id' => $user->id,
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->where('id', '!=', $id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $slug = $request->slug ?? Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        } else {
            $imagePath = $category->image;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imagePath,
            'parent_id' => $request->parent_id,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
    // Add edit, update, destroy methods as needed
}
