@extends('layouts.admin_layout')
@section('header_page')
    {{ __('change password') }}
@endsection
@section('title')
    {{ __('change password') }}
@endsection
@section('name'){{ __('edit profile') }}@endsection
@section('href'){{ route('profile-user.edit', auth()->id()) }}@endsection
@section('name2'){{ __('profile') }}@endsection
@section('href2'){{ route('profile-user.show', auth()->id()) }}@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-body">
                <form method="POST" action="{{ route('reset.password') }}">
                    @csrf

                    @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                    @endforeach

                    <div class="form-group row">
                        <label for="password"
                               class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="current_password"
                                   autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                               class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                        <div class="col-md-6">
                            <input id="new_password" type="password" class="form-control" name="new_password"
                                   autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                               class="col-md-4 col-form-label text-md-right">{{ __('New Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="new_confirm_password" type="password" class="form-control"
                                   name="new_confirm_password" autocomplete="current-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <a class="btn badge-warning"
                               href="{{route('profile-user.show', auth()->id()) }}">{{__('Go Back')}} <i
                                    class="fas fa-arrow-left"></i></a>
                            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i
                                    class="fas fa-check"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
