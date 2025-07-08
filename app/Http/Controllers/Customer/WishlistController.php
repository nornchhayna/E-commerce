<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class WishlistController extends Controller
{


    public function boot()
    {
        View::composer('customer.layouts.app', function ($view) {
            $wishlistCount = 0;
            if (Auth::check()) {
                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
            }
            $view->with('wishlistCount', $wishlistCount);
        });
    }

    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Product already in wishlist']);
            }
            return redirect()->back()->with('info', 'Product already in wishlist.');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Product added to wishlist']);
        }

        return redirect()->back()->with('success', 'Product added to wishlist.');
    }


    public function destroy($id)
    {
        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist.');
    }
}
