<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Components\ProductImage;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the Blade component
        Blade::component('product-image', ProductImage::class);

        // Share categories with the customer dashboard view
        View::composer('customer.dashboard', function ($view) {
            $categories = Category::whereNull('parent_id')
                ->where('is_active', true)
                ->with(['children' => function ($query) {
                    $query->where('is_active', true)->orderBy('sort_order');
                }])
                ->orderBy('sort_order')
                ->get();

            $view->with('categories', $categories);
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register any application services
    }
}
