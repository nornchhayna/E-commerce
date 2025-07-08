<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductAdminController;

Route::get('/admin', function () {
    return view('admin'); // ✅ this looks for resources/views/admin.blade.php
})->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::resource('products', ProductAdminController::class);