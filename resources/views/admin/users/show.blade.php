@extends('layouts.admin_layout')

@section('header_page')
    {{ __('show user') }}
@endsection
@section('title')
    {{ __('show user') }}
@endsection
@can('user-per')
    @section('name'){{ __('users') }}@endsection
    @section('href'){{ route('users.index') }}@endsection
    @section('name2'){{ __('create') }}@endsection
    @section('href2'){{ route('users.create') }}@endsection
    @endcan
    @section('content')


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('name') }}</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('email') }}</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('roles') }}</strong>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ __($v) }}</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endsection
