@extends('layouts.admin_layout')
@section('header_page')
    {{__('create category')}}
    @endsection
@section('title')
    {{__('create category')}}
@endsection
@section('name'){{ __('trash') }}@endsection
@section('href'){{ route('categories.trash') }}@endsection
@section('name2'){{ __('categories') }}@endsection
@section('href2'){{ route('categories.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{route('categories.store')}}" method="post">
            @include('admin.category.form')
            <a class="btn badge-warning" href="{{route('categories.index')}}">{{__('Go Back')}}</a>
            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
        </form>
@endsection
