<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\OrderCreate;
use App\Mail\OrderCreatedEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderCreatedNotification;

class SendOrderCreatedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param OrderCreate $event
     * @return void
     */
    public function handle(OrderCreate $event)/*name of event*/
    {
        $role = DB::table('model_has_roles')->where('role_id', '1')
            ->where('model_type', 'App\Models\User')->first();
        $user = User::where('id', $role->model_id)->firstOrFail();
        $order = $event->order;

        $user->notify(new OrderCreatedNotification($order));
        Mail::send(new OrderCreatedEmail($order));
    }
}
