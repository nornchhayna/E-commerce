<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all users for now (you can apply auth middleware separately)
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $this->product,
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'sku' => 'required|string|max:100|unique:products,sku,' . $this->product,
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'nullable|string', // or 'image' if uploading directly
            'weight' => 'nullable|integer|min:0',
            'dimensions' => 'nullable|array',
            'dimensions.length' => 'nullable|numeric|min:0',
            'dimensions.width' => 'nullable|numeric|min:0',
            'dimensions.height' => 'nullable|numeric|min:0',
            'track_inventory' => 'boolean',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'stock_status' => 'required|in:in_stock,out_of_stock,backorder',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'attributes' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
}
