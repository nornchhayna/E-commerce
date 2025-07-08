<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Store;
use App\Models\Category;
use App\Models\Inventory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'store_id',
        'name',
        'slug',
        'description',
        'account_id',
        'short_description',
        'sku',
        'price',
        'compare_price',
        'cost_price',
        'images',
        'weight',
        'dimensions',
        'track_inventory',
        'stock_quantity',
        'low_stock_threshold',
        'stock_status',
        'is_active',
        'is_featured',
        'attributes',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'price' => 'float',
        'compare_price' => 'float',
        'cost_price' => 'float',
        'images' => 'array',
        'dimensions' => 'array',
        'attributes' => 'array',
        'track_inventory' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('admin', function (Builder $builder) {
            // Ensure the user is authenticated and has admin privileges
            if (Auth::check() && Auth::user()->isAdmin()) {
                // Apply a global scope to filter by admin_id
                $builder->where('admin_id', Auth::user()->id);
            }
        });
    }

    // ... existing code ...



    /**
     * Check if product has images
     */
    public function hasImages()
    {
        $images = $this->images_array;
        return count($images) > 0;
    }

    /**
     * Get thumbnail image URL (first image)
     */
    public function getThumbnailAttribute()
    {
        return $this->first_image_url ?: asset('images/no-image-placeholder.png');
    }

    // Relationship to admin (owner)
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Relationship to store (same as coupon model)
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => number_format($value, 2),
            set: fn($value) => str_replace(',', '', $value)
        );
    }

    protected function comparePrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? number_format($value, 2) : null,
            set: fn($value) => $value ? str_replace(',', '', $value) : null
        );
    }

    protected function costPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? number_format($value, 2) : null,
            set: fn($value) => $value ? str_replace(',', '', $value) : null
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_status', 'in_stock');
    }

    public function getHasDiscountAttribute(): bool
    {
        return $this->compare_price && $this->compare_price > $this->price;
    }

    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->has_discount) {
            return 0;
        }
        return round(($this->compare_price - $this->price) / $this->compare_price * 100);
    }

    public function getMainImageAttribute()
    {
        return $this->images ? $this->images[0] : null;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function updateStock(int $quantity): void
    {
        if (!$this->track_inventory) {
            return;
        }

        $this->stock_quantity += $quantity;

        // Update stock status
        if ($this->stock_quantity <= 0) {
            $this->stock_status = 'out_of_stock';
        } elseif ($this->stock_quantity < $this->low_stock_threshold) {
            $this->stock_status = 'backorder';
        } else {
            $this->stock_status = 'in_stock';
        }

        $this->save();
    }
}
