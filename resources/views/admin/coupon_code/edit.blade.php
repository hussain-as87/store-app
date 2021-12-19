@extends('layouts.admin_layout')
@section('header_page')
{{__('edit coupon')}}
@endsection
@section('title')
{{__('edit coupon')}}
@endsection
@section('name'){{ __('all') }}@endsection
@section('href'){{ route('coupons.index') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
<div class="container">
    <form action="{{route('coupons.update', $coupon->id)}}" method="post">
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
        @method('put')
        @php
        $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
        @endphp
        <h2 class='text-center'><span class='text-primary '>{{ __('code') }} : </span> {{ $formatter->format($coupon->discount_value) }}</h2>
        <p class='text-center'><span class='text-primary '>{{ __('discount value') }} : </span> {{ $coupon->code }}</p>

        <br />
        <div class="col-auto">
            <select name="is_active" id="is_active" class="form-control mb-4 @error('is_active')  alert-danger @enderror">
                <option value="1" {{$coupon->is_active == 1 ? ' selected' : '' }}>{{ __('active') }}</option>
                <option value="0" {{$coupon->is_active == 0 ? ' selected' : '' }}>{{ __('inactive') }}</option>
            </select></div>
        <br />
        <a class="btn badge-warning" href="{{route('coupons.index')}}">{{__('Go Back')}} <i class="fas fa-arrow-left"></i></a>
        <button type="submit" class="btn btn-success ">{{ __('Submit') }} <i class="fas fa-check"></i></button>
    </form>
</div>
@endsection
