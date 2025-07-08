@extends('customer.layouts.app')

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
    <a href="{{ route('catalog.show', $product->slug) }}">
        <div class="h-48 bg-gray-100 flex items-center justify-center">
            @if($product->images)
                <img src="{{ json_decode($product->images)[0] }}" alt="{{ $product->name }}" class="h-full object-cover">
            @else
                <span class="text-gray-400">No image</span>
            @endif
        </div>
    </a>

    <div class="p-4">
        <h3 class="font-semibold text-lg mb-1">
            <a href="{{ route('catalog.show', $product->slug) }}" class="hover:text-blue-600">
                {{ $product->name }}
            </a>
        </h3>

        <div class="flex items-center justify-between mt-2">
            <span class="text-lg font-bold">
                ${{ number_format($product->price, 2) }}
                @if($product->compare_price)
                    <span class="text-sm text-gray-500 line-through ml-1">
                        ${{ number_format($product->compare_price, 2) }}
                    </span>
                @endif
            </span>

            @if($product->stock_status === 'out_of_stock')
                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Out of Stock</span>
            @elseif($product->stock_status === 'backorder')
                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Backorder</span>
            @endif
        </div>
    </div>
</div>