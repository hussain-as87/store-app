@extends('layouts.admin_layout')
@section('header_page')
{{ __('advert') }}
@endsection
@section('title')
{{ __('advert') }}
@endsection
@section('name'){{ __('products') }}@endsection
@section('href'){{ route('products.index') }}@endsection
@can('advert-create')
@section('name2'){{ __('create') }}@endsection
@section('href2'){{ route('adv.create') }}@endsection
@endcan
@section('content')
<livewire:advert-data-table>
    @endsection
