@extends('layouts.admin_layout')

@section('header_page')
    {{ __('edit user') }}
@endsection
@section('title')
    {{ __('edit user') }}
@endsection
@can('user-per')
    @section('name'){{ __('users') }}@endsection
    @section('href'){{ route('users.index') }}@endsection

    @section('name2'){{ __('create') }}@endsection
    @section('href2'){{ route('users.create') }}@endsection
    @endcan
    @section('content')
        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('name') }}</strong>
                    {!! Form::text('name', null, ['placeholder' => '', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('email') }}</strong>
                    {!! Form::text('email', null, ['placeholder' => '', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('Password') }}</strong>
                    {!! Form::password('password', ['placeholder' => '', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('confirm password') }}</strong>
                    {!! Form::password('confirm-password', ['placeholder' => '', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="form-label">{{ __('status') }} </label>
                    <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                        <option class="text-success" value="1" {{ $user->status === '1' ? 'selected' : '' }}>
                            {{ __('active') }}</option>
                        <option class="text-danger" value="0" {{ $user->status === '0' ? 'selected' : '' }}>
                            {{ __('inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>{{ __('roles') }}</strong>
                    {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
            </div>
        </div>
        {!! Form::close() !!}
    @endsection
