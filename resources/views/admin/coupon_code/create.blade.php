@extends('layouts.admin_layout')
@section('header_page')
{{__('create product')}}
@endsection
@section('title')
{{__('create product')}}
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
        <div class="form-group">
            <label for="discount_value">{{ __('discount value') }}</label>
            <input type="text" name="discount_value" class="form-control @error('discount_value') is-invalid alert-danger @enderror" id="discount_value" value="{{ old('discount_value') }}" placeholder="@error('discount_value'){{ $message }} @enderror">
        </div>
        <div class="form-group">
            <label for="code">{{ __('code') }}</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="0">{{ __('active') }}</option>
                <option value="1">{{ __('inactive') }}</option>
            </select> </div>

        <a class="btn badge-warning" href="{{route('coupons.index')}}">{{__('Go Back')}}</a>
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </form>
</div>
@endsection
