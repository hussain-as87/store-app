<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $content, $receiver;

    protected $rules = [
        'content' => 'required',
    ];

    /* to load more */
    public $limitPerPage = 10;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];




    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 2;
    }


    public function render()
    {
        $user = Auth::user();
        $messages = Message::with('senderUser', 'receiverUser.profile')
            ->where('sender', $user->id)
            ->orwhere('receiver', $user->id)
            ->paginate($this->limitPerPage);
        $this->emit('userStore');
        return view('livewire.chat', compact('messages'));
    }

    public function sendMessage($receiverid)
    {
        $validatedData = $this->validate();
        $message = Message::create([
            'content' => $this->content,
            'receiver' => $receiverid,
            'sender' => auth()->id(),
        ]);

        broadcast(new MessageSent($message));
        $this->reset('content');
    }
}
