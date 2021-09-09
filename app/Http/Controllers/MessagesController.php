<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userauth = Auth::user();

        $users = User::with('profile', 'messages')->where('id', '=!', $userauth->id)->get();
        return view('chat.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'receiver' => 'required|exists:users,id'
        ]);
        $sender = Auth::user();
        $receiver = User::find($request->post('receiver'));

        $message = $sender->sentMessages()->create($request->all());
        broadcast(new MessageSent($message));
        return $message->load('senderUser', 'receiverUser');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userauth = Auth::user();
        $users = User::with('profile', 'messages')->where('id', '=!', $userauth->id)->get();
        $messages = Message::with('senderUser', 'receiverUser')
            ->where('sender', $userauth->id)
            ->orwhere('receiver', $id)
            ->latest()
            /** by data of meesgae */
            ->get();

        $receiver = User::with('profile')->findOrFail($id);
        $message = Message::where('receiver', $id)->update(['read_at' => Carbon::now()]);
        return view('chat.show', compact('messages', 'users', 'receiver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $message = $user->messages()->find($id);
        $message->readAt();
        return $message;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $message = Message::findOrFail($id);

        if ($user->id == $message->sender || $user->id == $message->receiver) {
            $message->delete();
        }
        return [
            'status' => 201,
            'message' => 'Deleted !!'
        ];
    }
}
