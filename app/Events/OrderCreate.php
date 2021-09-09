<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/*(Contracts) interface*/

class OrderCreate implements ShouldBroadcast /*important on broadcast*/
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    /*anything pubic here will return in broadcast */
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('orders');
    }

    public function broadcastAs()/*name of broadcast*/
    {
        return 'order.create';
    }
    /*if i want to send just information about thing i needed*/
    public function broadcastWith()
    {
        return [
            'user' => auth()->user(),
            'order' => $this->order
        ];
    }
}
