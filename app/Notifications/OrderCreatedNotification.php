<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'/* ,'nexmo' */];
        /* $via = ['database'];
         if ($notifiable->email_notify) {
             $via[] = ['mail'];
         }
         if ($notifiable->sms_notify) {
             $via[] = ['nexmo'];
         }
         return $via;*/
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;
        $message
            ->subject('new order')
            ->greeting('welcome to you ms ' . $notifiable->name)
            ->line('new order has been created.(' . $this->order->id . ')')
            ->action('Notification Action', url(route('order.index')))
            ->line('Thank you for using our application!')/*->view()*/
        ;
        return $message;
    }

    public function toDatabase()
    {
        return [
            'message' => 'a new order has been created (order #' . $this->order->id . ')',
            'action' => route('order.index'),
            'icon' => '<i class="fas fa-file-invoice"></i>'
        ];
    }

    public function toBroadcast()
    {
        return [
            'message' => 'a new order has been created (order #' . $this->order->id . ')',
            'action' => route('order.index'),
            'icon' => '<i class="fas fa-file-invoice"></i>',
            'order' => $this->order
        ];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param mixed $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('new order has been created (#' . $this->order->id . ')')
            ->from(env('APP_NAME'));
    }
    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    /**
     * Get the Vonage / Shortcode representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toShortcode($notifiable)
    {
        return [
            'type' => 'alert',
            'custom' => [
                'code' => 'ABC123',
            ],
        ];
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
