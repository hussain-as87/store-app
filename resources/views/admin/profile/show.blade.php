@extends('layouts.admin_layout')
@section('title')
    {{ __('profile') }}
@endsection
@section('header_page')
    {{ __('profile') }}
@endsection
@section('name'){{ __('edit profile') }}@endsection
@section('href'){{ route('profile-user.edit', auth()->id()) }}@endsection
@section('name2'){{ __('change password') }}@endsection
@section('href2'){{ route('change.password', auth()->id()) }}@endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <h3>
                    <a href="{{ route('profile-user.edit', auth()->id()) }}"><img src="@if ($profile->avatar) {{ asset('storage/' . $profile->avatar) }}
                    @else
                        https://ui-avatars.com/api/?name={{ auth()->user()->name }} @endif"
                        width="100" height="100"
                        style="border-radius: 50px"/></a>
                </h3>

                <h2><span>{{__('email')}} : </span>{{ $profile->user->email }}</h2>
                <h3><span>{{__('first name')}} : </span>{{ $profile->first_name }}</h3>
                <h3><span>{{__('last name')}} : </span>{{ $profile->last_name }}</h3>
                <h3><span>{{__('country')}} : </span>{{ $profile->country }}</h3>
                <h3><span>{{__('phone')}} : </span>{{ $profile->phone ? '+ ' . $profile->phone : '' }}</h3>
                <h3><span>{{__('address')}} : </span>{{ $profile->address }}</h3>
                <hr />

            </div>
        </div>
    </div>
@endsection
