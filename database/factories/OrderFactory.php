<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $subtotal = $this->faker->randomFloat(2, 10, 1000);
        return [
            'order_number' => Str::uuid(),
            'user_id' => User::factory(),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'tax_amount' => 0,
            'shipping_amount' => 0,
            'discount_amount' => 0,
            'total_amount' => $subtotal,
            'currency' => 'USD',
            'billing_first_name' => $this->faker->firstName,
            'billing_last_name' => $this->faker->lastName,
            'billing_email' => $this->faker->safeEmail,
            'billing_phone' => $this->faker->phoneNumber,
            'billing_address' => $this->faker->streetAddress,
            'billing_city' => $this->faker->city,
            'billing_state' => $this->faker->state,
            'billing_zip_code' => $this->faker->postcode,
            'billing_country' => $this->faker->country,
            'shipping_first_name' => $this->faker->firstName,
            'shipping_last_name' => $this->faker->lastName,
            'shipping_address' => $this->faker->streetAddress,
            'shipping_city' => $this->faker->city,
            'shipping_state' => $this->faker->state,
            'shipping_zip_code' => $this->faker->postcode,
            'shipping_country' => $this->faker->country,
            'shipping_method' => 'standard',
            'payment_method' => $this->faker->randomElement(['PayPal', 'PayWay']), // Add default
            'payment_status' => 'pending',
            'transaction_id' => null,
            'payment_date' => null,
            'notes' => null,
        ];
    }
}
