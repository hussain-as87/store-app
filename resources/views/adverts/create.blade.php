@extends('layouts.admin_layout')
@section('header_page')
    {{__('create advert')}}
@endsection
@section('title')
    {{__('create advert')}}
@endsection
@section('name'){{ __('index') }}@endsection
@section('href'){{ route('adv.index') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{route('adv.store')}}" method="post" enctype="multipart/form-data">
            @include('adverts.form')
            <a class="btn badge-warning" href="{{route('adv.index')}}">{{__('Go Back')}}</a>
            <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
        </form>
    </div>
@endsection
