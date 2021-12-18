<div wire:poll.750ms>
    @foreach ($messages as $key => $user)
        <a class="list-group-item list-group-item-action active text-white rounded-0"
           href="{{ route('messages.show', $user->senderUser->id) }}">
            <div class="media">
                <img src=" {{--  @if ($user->senderUser->profile->avatar) {{ asset('storage/' . $user->senderUser->profile->avatar) }}
                @else --}}
                    https://ui-avatars.com/api/?name={{ $user->senderUser->name }} {{-- @endif --}} " width="50"
                     class="rounded-circle">
                <div class="media-body ml-4">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <h6 class="mb-0">{{ $user->senderUser->name }}</h6><small class="small font-weight-bold">
                            {{-- @if ($user->messages->read_at)
                            {{ $user->messages->read_at->diffForHumans()  }}
                        @endif --}}
                        </small>
                    </div>
                </div>
            </div>
        </a>

    @endforeach
</div>
