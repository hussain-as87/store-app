@extends('layouts.admin_layout')
@section('header_page')
    {{ __('create role') }}
@endsection
@section('title')
    {{ __('create role') }}
@endsection
@can('user-per')
    @section('name'){{ __('users') }}@endsection
    @section('href'){{ route('users.index') }}@endsection
    @endcan
    @can('role-list')
        @section('name2'){{ __('roles') }}@endsection
        @section('href2'){{ route('roles.index') }}@endsection
        @endcan

        @section('content')

            {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ __('name') }}</strong>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ __('permission') }}</strong>
                        <br />
                        @foreach ($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                {{ __($value->name) }}</label>
                            <br />
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                   <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
                </div>
            </div>
            {!! Form::close() !!}
        @endsection
