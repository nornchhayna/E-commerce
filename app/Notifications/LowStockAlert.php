<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockAlert extends Notification
{
    use Queueable;

    protected $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Low Stock Alert',
            'message' => "The product '{$this->product->name}' is low in stock.",
            'product_id' => $this->product->id,
            'stock_quantity' => $this->product->stock_quantity,
        ];
    }
}
