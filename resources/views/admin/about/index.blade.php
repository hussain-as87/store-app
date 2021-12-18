@extends('layouts.admin_layout')
@section('header_page')
    {{__('about')}}
@endsection
@section('title')
    {{__('about')}}
@endsection
@section('name'){{ __('edit') }}@endsection
@section('href'){{ route('about.edit') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
    <div class="container">
        <div class="card col-12 py-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">{{__('Our Story')}}</h5>
                        <p class="card-text"> {{ $about->story  }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid " src="{{ asset('storage/images/about/'.$about->story_image) }}" alt="">
                    </div>
                </div>

            </div>
        </div>
        <div class="card col-12 py-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title"> {{__('Our Mission')}}</h5>
                        <p class="card-text"> {!! $about->service !!}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid  " src="{{ asset('storage/images/about/'.$about->service_image) }}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
@endsection
