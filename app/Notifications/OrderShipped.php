<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderShipped extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Specify channels
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line('Your order has been shipped.')
            ->action('Track Order', url('/orders/' . $this->order->id))
            ->line('Thank you for your purchase!');
    }
}
