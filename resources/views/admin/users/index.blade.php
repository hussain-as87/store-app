@extends('layouts.admin_layout')

@section('header_page')
    {{ __('users') }}
@endsection
@section('title')
    {{ __('users') }}
@endsection
@can('user-per')
@section('name'){{ __('create') }}@endsection
@section('href'){{ route('users.create') }}@endsection
@endcan
@can('role-list')
@section('name2'){{ __('roles') }}@endsection
@section('href2'){{ route('roles.index') }}@endsection
@endcan
@section('content')
    <livewire:data-table-users/>
@endsection
