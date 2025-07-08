<?php

use App\Http\Controllers\Customer\ApiAddressController;
use App\Models\Address;
use Illuminate\Support\Facades\Route;

Route::apiResource(name: 'addresses', controller: ApiAddressController::class);
