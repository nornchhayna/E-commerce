@extends('admin.layouts.admin')

@section('title', 'Delete Product')
<form action="{{ route('admin.products.destroy', $product) }}" method="POST"
    onsubmit="return confirm('Are you sure you want to delete this product?');" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500 hover:underline">Delete</button>
</form>