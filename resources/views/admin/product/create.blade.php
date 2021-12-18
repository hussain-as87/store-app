@extends('layouts.admin_layout')
@section('header_page')
    {{__('create product')}}
@endsection
@section('title')
    {{__('create product')}}
@endsection
@section('name'){{ __('trash') }}@endsection
@section('href'){{ route('products.trash') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @include('admin.product.form')
            <a class="btn badge-warning" href="{{route('products.index')}}">{{__('Go Back')}} <i
                    class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
        </form>
    </div>
@endsection
