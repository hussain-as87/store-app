@extends('layouts.admin_layout')
@section('header_page')
    {{__('create coupon')}}
@endsection
@section('title')
    {{__('create coupon')}}
@endsection
@section('name'){{ __('all') }}@endsection
@section('href'){{ route('coupons.index') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
    <div class="container">
        <form action="{{route('coupons.store')}}" method="post" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf

            <div class="col-auto">
                <label class="sr-only" or="discount_value">{{ __('discount value') }}</label>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">%</div>
                    </div>
                    <input type="number" name="discount_value"
                           class="form-control @error('discount_value') is-invalid alert-danger @enderror"
                           id="discount_value" value="{{ old('discount_value') }}"
                           placeholder="{{ __('enter discount value') }}">
                </div>
            </div>
            <div class="col-auto">
                <select name="is_active" id="is_active"
                        class="form-control mb-4 @error('discount_value')  alert-danger @enderror">
                    <option value="">{{ __('choose option') }}</option>
                    <option value="1">{{ __('active') }}</option>
                    <option value="0">{{ __('inactive') }}</option>
                </select></div>

            <a class="btn badge-warning" href="{{route('coupons.index')}}">{{__('Go Back')}} <i
                    class="fas fa-arrow-left"></i></a>
            <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
        </form>
    </div>
@endsection
