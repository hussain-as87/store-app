@extends('layouts.store_layout')
@section('content')

    <div class="container py-5 px-4">
        <!-- For demo purpose-->


        <div class="row rounded-lg overflow-hidden shadow">
            <!-- Users box-->
            <div class="col-5 px-0">
                <div class="bg-white">

                    <div class="bg-gray px-4 py-2 bg-light">
                        <p class="h5 mb-0 py-1">Recent</p>
                    </div>

                    <div class="messages-box">
                        <div class="list-group rounded-0">

                            <livewire:side-bar :receiver="$receiver"  />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chat Box-->
            <div class="col-7 px-0">
                <livewire:chat :receiver="$receiver" />
            </div>
        </div>
    </div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script>
            function addmessage(msg) {
                let messages = $('#messages');
                messages.append(`

                   <!-- Sender Message-->
                    <div class="media w-50 mb-3"><img
                            src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt=" ${msg.receiver_user.name}"
                            width="50" class="rounded-circle">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-muted"> ${msg.content}</p>
                            </div>
                            <p class="small text-muted">${msg.created_at}</p>
                        </div>
                    </div>

                    <!-- Reciever Message-->
                    <div class="media w-50 ml-auto mb-3">
                        <div class="media-body">
                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-white"> ${msg.content}
                                </p>
                            </div>
                            <p class="small text-muted"> ${msg.created_at}</p>
                        </div>
                    </div>
                    `);
            }
            ////////////////////////////////////////
            function getMessages() {
                $.getJSON("{{ route('messages.index') }}", function(data) {
                    for (i in data) {
                        let msg = data[i];
                        addmessage(msg)
                    }
                });
            }
            ///////////////////
            function sendMessage(message, receiver) {
                $.post("{{ route('messages.store') }}", {
                    "content": message,
                    "receiver": receiver,
                    "_token": "{{ csrf_token() }}"
                }, function(msg) {
                    /* addmessage(msg) */
                });
            }
            /////////////////////////**////////////////////////
            $(document).ready(function() {
                getMessages();
                $('#sendMessage').on('submit', function(e) {
                    e.preventDefault();
                    sendMessage($('#content').val(), $('#receiver').val());
                    $('#content').val('')
                });
            });
        </script> --}}
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('adaff61a4de5d79cd919', {
            cluster: 'eu',
            authEndpoint: '/broadcasting/auth',
        });

        var channel = pusher.subscribe('private-chat');
        channel.bind('new-message', function(msg) {
            addmessage(msg);
        });
    </script>

@endsection
