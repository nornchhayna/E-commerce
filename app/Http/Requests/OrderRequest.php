<?php


namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }


    public function rules(): array
    {

        return [
            'billing_f
            irst_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_email' => 'required|email|max:255',
            'billing_phone' => 'nullable|string|max:20',
            'billing_address' => 'required|string|max:255',
            'billing_city' => 'required|string|max:100',
            'billing_state' => 'required|string|max:100',
            'billing_zip_code' => 'required|string|max:20',
            'billing_country' => 'required|string|max:100',
            'shipping_first_name' => 'required|string|max:255',
            'shipping_last_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zip_code' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'shipping_method' => 'required|string|max:100',
            'subtotal' => 'required|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'shipping_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
        ];
    }
}
