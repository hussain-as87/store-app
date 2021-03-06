@extends('layouts.admin_layout')
@section('header_page')
    {{__('create subcategory')}}
@endsection
@section('title')
    {{__('create subcategory')}}
@endsection
@section('name'){{ __('trash') }}@endsection
@section('href'){{ route('subcategories.trash') }}@endsection
@section('name2'){{ __('categories') }}@endsection
@section('href2'){{ route('categories.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{route('subcategories.store')}}" method="post">
            @include('admin.subcategory.form')
            <br/>
            <a class="btn badge-warning" href="{{route('categories.index')}}">{{__('Go Back')}} <i
                    class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
        </form>
@endsection
