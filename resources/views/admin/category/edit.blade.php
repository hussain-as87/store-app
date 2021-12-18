@extends('layouts.admin_layout')
@section('header_page')
    {{__('edit category')}}
@endsection
@section('title')
    {{__('edit category')}}
@endsection
@section('name'){{ __('trash') }}@endsection
@section('href'){{ route('categories.trash') }}@endsection
@section('name2'){{ __('categories') }}@endsection
@section('href2'){{ route('categories.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{route('categories.update',['category'=>$category->id])}}" method="post"
              enctype="multipart/form-data">
            @method('PUT')
            @include('admin.category.form')
            <br/>
            <a class="btn badge-warning" href="{{route('categories.index')}}">{{__('Go Back')}} <i
                    class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
        </form>
    </div>

@endsection
