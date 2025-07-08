<?php

namespace App\Services;

class ShippingService
{
    public function getAvailableMethods()
    {
        return [
            ['id' => 'standard', 'name' => 'Standard Shipping', 'cost' => 5.00],
            ['id' => 'express', 'name' => 'Express Shipping', 'cost' => 15.00],
        ];
    }

    public function calculateShipping($methodId)
    {
        $methods = $this->getAvailableMethods();
        foreach ($methods as $method) {
            if ($method['id'] === $methodId) {
                return $method['cost'];
            }
        }
        return 0.00;
    }
}
