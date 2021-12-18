<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;

class SideBar extends Component
{
    public function render()
    {
        $messages = Message::with('senderUser', 'receiverUser.profile')
            ->where('sender', '=!', auth()->id())
            ->orwhere('receiver', auth()->id())
            ->orderBy('created_at')
            ->select('sender', 'receiver')->distinct()
            ->get();
        return view('livewire.side-bar', compact('messages'));
    }
}
