@extends('layouts.admin_layout')
@section('header_page')
    {{ __('edit setting') }}@endsection
@section('title')
    {{ __('edit setting') }}@endsection
@section('name'){{ __('settings') }}@endsection
@section('href'){{ route('settings.index') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{ route('settings.update',$setting->id) }}" method="post">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ __('name') }}: <b>{{ $setting->name }}</b></strong>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ __('value') }}:</strong>
                        <input type="text" name="value" id="" placeholder="{{ __('value') }}" class="form-control"
                               value="{{ $setting->value }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn badge-warning" href="{{route('settings.index')}}">{{__('Go Back')}} <i
                            class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
