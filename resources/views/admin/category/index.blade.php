@extends('layouts.admin_layout')
@section('header_page')
    {{ __('categories') }}
@endsection
@section('title')
    {{ __('categories') }}
@endsection
@section('name'){{ __('trash') }}@endsection
@section('href'){{ route('categories.trash') }}@endsection
@section('name2'){{ __('create') }}@endsection
@section('href2'){{ route('categories.create') }}@endsection
@section('content')
   <livewire:data-tablecategories :category="$category">
@endsection
