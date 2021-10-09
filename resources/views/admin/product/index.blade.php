@extends('layouts.admin_layout')
@section('header_page')
    {{ __('products') }}
@endsection
@section('title')
    {{ __('products') }}
@endsection
@section('name'){{ __('trash') }}@endsection
@section('href'){{ route('products.trash') }}@endsection
    @can('product-create')
        @section('name2'){{ __('create') }}@endsection
        @section('href2'){{ route('products.create') }}@endsection
        @endcan
        @section('content')
            <livewire:data-table-products>
        @endsection
