@extends('layouts.admin_layout')
@section('header_page')
    {{ __('show role') }}
@endsection
@section('title')
    {{ __('show role') }}
@endsection
@can('role-list')
@section('name2'){{ __('roles') }}@endsection
@section('href2'){{ route('roles.index') }}@endsection
@endcan

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('name') }}</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('permissions') }}</strong>
                @if (!empty($rolePermissions))
                    @foreach ($rolePermissions as $v)
                        <label class="label label-success">{{ __($v->name) }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
