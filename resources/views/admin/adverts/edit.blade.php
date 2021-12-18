@extends('layouts.admin_layout')
@section('header_page')
    {{ __('edit advert') }}
@endsection
@section('title')
    {{ __('edit advert') }}
@endsection
@section('name'){{ __('create') }}@endsection
@section('href'){{ route('adv.create') }}@endsection
@section('name2'){{ __('advert') }}@endsection
@section('href2'){{ route('adv.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{ route('adv.update', $advert->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.adverts.form')
            <a class="btn badge-warning" href="{{ route('adv.index') }}">{{__('Go Back')}} <i
                    class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
        </form>
    </div>
@endsection
