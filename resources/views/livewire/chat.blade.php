<div wire:poll.750ms>
    <div class="px-4 py-5 chat-box bg-white" id="chat_box">
    @forelse ($messages as $msg)
        @if ($msg->sender === auth()->id())
            @if ($msg->sender === auth()->id() && $msg->receiver === $receiver->id)
                <!-- Sender Message-->
                    <div class="media w-50 ml-auto mb-3">
                        <div class="media-body">
                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-white">{{ $msg->content }}
                                </p>
                            </div>
                            <p class="small text-muted">{{ $msg->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
            @endif
        @else
            @if ($msg->receiver === auth()->id() && $msg->sender === $receiver->id)
                <!-- Reciever Message-->
                    <div class="media w-50 mb-3"><img
                            src="{{-- @if ($receiver->profile->avatar) {{ asset('storage/' . $receiver->profile->avatar) }} --}}
                            {{-- @else --}}
                                https://ui-avatars.com/api/?name={{ $receiver->name }} {{-- @endif --}}"
                            alt="{{ $msg->receiverUser->name }}" width="50" class="rounded-circle">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-muted">{{ $msg->content }}</p>
                            </div>
                            <p class="small text-muted">{{ $msg->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endif
            @endif

        @empty
            <p class="danger-alert">{{ __('no messages !') }}</p>
        @endforelse
    </div>
    <form wire:submit.prevent="sendMessage({{ $receiver->id }})">
        @csrf
        <div class="input-group">
            <input type="text" placeholder="Type a message" aria-describedby="button-addon2" wire:model="content"
                   class="form-control rounded-0 border-0 py-4 bg-light" name="content">

            <div class="input-group-append">
                <button id="send" type="submit" class="btn btn-link"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        window.onscroll = function (ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('load-more');
            }
        };
    </script>
</div>
