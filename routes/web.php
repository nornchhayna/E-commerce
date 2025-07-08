<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\TodoAdminController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\InventoryAdminController;
use App\Http\Controllers\Admin\CouponAdminController;
use App\Http\Controllers\Admin\SupportAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Controllers\Customer\SupportTicketController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\AddressController;


Route::view('/about', 'about')->name('about');

// Catalog Page
Route::view('/catalog', 'catalog')->name('catalog.index');

// Services Page
Route::view('/services', 'services')->name('services');

// Support Page
Route::view('/support', 'support')->name('support.index');

// FAQ Page
Route::view('/faq', 'faq')->name('faq');

// Shipping Page
Route::view('/shipping', 'shipping')->name('shipping');

// Returns Page
Route::view('/returns', 'returns')->name('returns');

// Privacy Policy Page
Route::view('/privacy', 'privacy')->name('privacy');

// Terms of Service Page
Route::view('/terms', 'terms')->name('terms');

// Contact Page
Route::view('/contact', 'contact')->name('contact');

// Account Returns Page (for initiating returns)
// Route::view('/account/returns', 'account.returns')->name('account.returns');

// Account Orders Page (for tracking orders)
// Route::view('/account/orders', 'account.orders')->name('account.orders');

// Cookie Settings Page
// Route::view('/cookies', 'cookies')->name('cookies');

// Newsletter Subscription (requires controller for form processing)
// Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// // Contact Form Submission (requires controller for form processing)
// Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/notifications', [NotificationController::class, 'index'])->name('customer.notifications.index');

// Send notification (probably admin-only or API, consider middleware)
Route::post('/send-notification/{customerId}/{orderId}', [NotificationController::class, 'sendToCustomer']);

use App\Http\Controllers\Customer\ApiAddressController;





Route::get('/addresses', function () {
    return view('addresses');
    // Point to your Blade view
})->name('addresses');
// // Order Tracking Route
Route::middleware('auth')->prefix('customer/orders')->name('customer.orders.')->group(function () {
    Route::get('/track', [OrderController::class, 'track'])->name('track'); // Route for tracking form
    Route::get('/track/{order_number}', [OrderController::class, 'trackOrder'])->name('track.number'); // Route for tracking details
});

// Customer Catalog routes
Route::prefix('customer/catalog')->name('catalog.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/featured', [ProductController::class, 'featured'])->name('featured');
    Route::get('/search', [ProductController::class, 'search'])->name('search');
    // Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/customer/catalog/products/{slug}/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
});



// Wishlist routes (auth required)
// routes/web.php
Route::middleware('auth')->group(function () {
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});
Route::resource('products', ProductController::class);
Route::get('/products/{product}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');



// Route::middleware('auth')->prefix('cart')->name('cart.')->group(function () {
//     Route::get('/', [CartController::class, 'index'])->name('index');
//     Route::post('/add', [CartController::class, 'add'])->name('add');
//     Route::patch('/update/{rowId}', [CartController::class, 'update'])->name('update');
//     Route::delete('/remove/{rowId}', [CartController::class, 'remove'])->name('remove');
//     Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
//     Route::post('/coupon', [CartController::class, 'applyCoupon'])->name('applyCoupon');
//     Route::post('/coupon/remove', [CartController::class, 'removeCoupon'])->name('removeCoupon');
//     Route::get('/payment/success', [CartController::class, 'paymentSuccess'])->name('payment.success');
//     Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('customer.orders.payment');
//     Route::get('/payment/cancel', [CartController::class, 'paymentCancel'])->name('payment.cancel');
//     Route::post('/payment/paypal/webhook', [CartController::class, 'paypalWebhook'])->name('payment.paypal.webhook');
//     Route::post('/payment/payway/webhook', [CartController::class, 'paywayWebhook'])->name('payment.payway.webhook');
// });

// Orders routes
Route::middleware('auth')->prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/create', [OrderController::class, 'create'])->name('create');
    Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('customer.orders.payment');
    Route::post('/create-step1', [OrderController::class, 'storeStep1'])->name('store.step1');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::get('/{order}/payment', [OrderController::class, 'payment'])->name('payment');
    Route::post('/{order}/payment', [OrderController::class, 'storePayment'])->name('store.payment');
});

// Temporary route - remove after fixing stock
// Add to web.php - TEMPORARY DEBUG ROUTE
Route::get('/test-stock-update/{productId}', function ($productId) {
    $product = \App\Models\Product::find($productId);

    if (!$product) {
        return "Product not found";
    }

    $oldStock = $product->stock;

    // Test update
    $product->update(['stock' => $oldStock - 1]);

    // Check if it actually updated
    $newStock = $product->fresh()->stock;

    return [
        'product_id' => $product->id,
        'name' => $product->name,
        'old_stock' => $oldStock,
        'new_stock' => $newStock,
        'update_successful' => $newStock !== $oldStock
    ];
});
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
    Route::post('/cart/coupon/remove', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');
    Route::get('/checkout', [OrderController::class, 'create'])->name('customer.orders.create');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('customer.orders.show');

    // Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store.step1');
    Route::get('/orders/{order}/payment', [OrderController::class, 'payment'])->name('customer.orders.payment');
    Route::post('/orders/{order}/payment', [OrderController::class, 'storePayment'])->name('customer.orders.payment.process');
    Route::get('/cart/payment/success', [CartController::class, 'paymentSuccess'])->name('customer.payment.success');
    Route::get('/cart/payment/cancel', [CartController::class, 'paymentCancel'])->name('customer.payment.cancel');
    Route::post('/payment/paypal/webhook', [CartController::class, 'paypalWebhook'])->name('customer.payment.paypal.webhook');
    Route::post('/payment/payway/webhook', [CartController::class, 'paywayWebhook'])->name('customer.payment.payway.webhook');
});



Route::middleware(['auth'])->prefix('support')->name('support.')->group(function () {
    Route::get('/', [SupportTicketController::class, 'index'])->name('index');
    Route::get('/create', [SupportTicketController::class, 'create'])->name('create');
    Route::post('/', [SupportTicketController::class, 'store'])->name('store');
    Route::get('/{id}', [SupportTicketController::class, 'show'])->name('show');
});




// Support Ticket routes (auth required)
Route::middleware('auth')->prefix('support')->name('support.')->group(function () {
    Route::get('/', [SupportTicketController::class, 'index'])->name('index');
    Route::get('/create', [SupportTicketController::class, 'create'])->name('create');
    Route::post('/', [SupportTicketController::class, 'store'])->name('store');
    Route::get('/{id}', [SupportTicketController::class, 'show'])->name('show');
});
// routes/web.php
Route::get('/notify/customer/{customerId}/order/{orderId}', [NotificationController::class, 'sendToCustomer']);

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


// Home page with product listing, filters, sorting, pagination
Route::get('/', function (Request $request) {
    $query = Product::query();

    // Filters
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // Sorting
    if ($request->sort === 'price_low') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'price_high') {
        $query->orderBy('price', 'desc');
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $products = $query->paginate(12)->withQueryString();

    return view('dashboard', compact('products'));
})->name('dashboard');

// Dashboard for authenticated users
Route::middleware('auth')->get('/dashboard', function () {
    $products = Product::all();

    $totalProducts = $products->count();
    $lowStockProducts = $products->where('stock_quantity', '<=', 'low_stock_threshold')->count();
    $outOfStockProducts = $products->where('stock_status', 'out_of_stock')->count();

    return view('dashboard', compact('products', 'totalProducts', 'lowStockProducts', 'outOfStockProducts'));
})->name('dashboard.authenticated');

// Admin routes protected by admin middleware
Route::middleware(['auth', AdminAuthenticate::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/product/{id}', [DashboardController::class, 'showProduct'])->name('admin.dashboard.showProduct');
    // Products
    Route::resource('products', ProductAdminController::class);




    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard/revenue', [DashboardController::class, 'getRevenueData']);
    Route::get('/admin/dashboard/orders', [DashboardController::class, 'getOrdersData']);
    // AJAX endpoints for dashboard data
    // Route::get('/dashboard/revenue-data', [DashboardController::class, 'getRevenueData'])->name('dashboard.revenue');
    // Route::get('/dashboard/order-stats', [DashboardController::class, 'getOrderStats'])->name('dashboard.orders');
    Route::get('/dashboard/metrics', [DashboardController::class, 'getMetrics'])->name('dashboard.metrics');
    // Orders
    // Route::resource('orders', OrderAdminController::class);
    Route::resource('orders', OrderAdminController::class);
    Route::get('orders/{order}/show', [OrderAdminController::class, 'show'])->name('orders.show');

    // Inventory
    Route::resource('inventory', InventoryAdminController::class);
    Route::get('inventory/{inventory}/show', [InventoryAdminController::class, 'show'])->name('inventory.show');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    // Categories

    Route::resource('categories', CategoryAdminController::class);

    Route::get('categories/{category}/show', [CategoryAdminController::class, 'show'])->name('categories.show');

    Route::post('/products/{product}/stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
    // Support

    Route::resource('support', SupportAdminController::class);

    Route::post('/admin/support/{support}', [SupportAdminController::class, 'update'])->name('admin.support.update');
    // Coupons
    Route::resource('coupons', CouponAdminController::class);
});

use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admins', [UserController::class, 'index'])->name('users.index');
    Route::get('/admins/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/admins', [UserController::class, 'store'])->name('users.store');
    Route::get('/admins/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admins/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admins/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
