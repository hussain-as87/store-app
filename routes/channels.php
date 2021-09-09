<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
/*if auth user id == user in channel*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('orders', function ($user/* ,$id */) {
    /*     $order=\App\Models\Order::findOrFail($id); */
    return true/* $user->type == 'super_admin' */ /* || (int) $user->id === (int) $id */;
});


Broadcast::channel('chat', function () {
    return true;
});
