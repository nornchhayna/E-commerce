<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'admin_id',
        'image',
        'parent_id',
        'sort_order',
        'is_active',
    ];
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    // protected static function booted()
    // {
    //     static::addGlobalScope('admin', function (Builder $builder) {
    //         // Ensure the user is authenticated and has admin privileges
    //         if (Auth::check() && Auth::user()->isAdmin()) {
    //             // Apply a global scope to filter by admin_id
    //             $builder->where('admin_id', Auth::user()->id);
    //         }
    //     });
    // }
    // Relationship: Parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    // app/Models/Category.php

    // app/Models/Category.php

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
