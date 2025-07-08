<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Order;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Order Status Updated',
            'message' => "Your order #{$this->order->order_number} status changed to '{$this->order->status}'.",
            'order_id' => $this->order->id,
            'status' => $this->order->status,
            'store_id' => $this->order->store_id,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Order Status has been Updated')
                    ->line("Hello {$notifiable->name},")
                    ->line("The status of your order #{$this->order->order_number} has been updated to '{$this->order->status}'.")
                    ->action('View Order', url('/orders/' . $this->order->id))
                    ->line('Thank you for shopping with us!');
    }
}
