<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order, $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.s
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $this->subject('new order created');
        $this->from('adda5mad@outlook.com', config('app.name'));
        $this->to($order->user->email);
        return $this->view('mails.order-created', compact('order'));
    }
}
