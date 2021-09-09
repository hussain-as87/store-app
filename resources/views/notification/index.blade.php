@extends('layouts.store_layout')
@section('title')
    {{__('notification')}}
@endsection
@section('content')
    <div class="container py-5">
        <table class="table">
            <thead>
            <tr>
                <th>{{__('notification')}}</th>
                <th>{{__('time')}}</th>
                <th>{{__('read at')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($notification as $item)
                <tr class="{{$item->read() ? '':'bg-info'}}">
                    <th><a href="{{route('notification.read',$item->id)}}">{{$item->data['message']}}</a></th>
                    <th>{{$item->created_at->diffForHumans()}}</th>
                    <th>
                        @if ($item->read_at != null)
                            {{$item->read_at->diffForHumans()}}
                        @endif
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
