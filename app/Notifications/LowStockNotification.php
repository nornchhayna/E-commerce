<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LowStockNotification extends Notification
{
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
            'message' => "The product {$this->product->name} is running low on stock.",
            'product_id' => $this->product->id,
            'sku' => $this->product->sku,
            'stock_quantity' => $this->product->stock_quantity,
        ];
    }
}
