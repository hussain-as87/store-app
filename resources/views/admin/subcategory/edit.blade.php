@extends('layouts.admin_layout')
@section('header_page')
    {{__('edit subcategory')}}
@endsection
@section('title')
    {{__('edit subcategory')}}
@endsection
@section('name'){{ __('trash') }}@endsection
@section('href'){{ route('subcategories.trash') }}@endsection
@section('name2'){{ __('create') }}@endsection
@section('href2'){{ route('subcategories.create') }}@endsection
@section('content')
    <div class="container">
        <form action="{{route('subcategories.update',$subcategory->id)}}" method="post">
            @method('PUT')
            @include('admin.subcategory.form')
            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
        </form>
    </div>

@endsection
