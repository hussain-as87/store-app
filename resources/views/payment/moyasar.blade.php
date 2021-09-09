@extends('layouts.store_layout')
@section('content')
    <div class="contianer">
        <form action="https://api.moyasar.com/v1/payments.html" method="post" class="form-control">
            <input type="hidden" name="callback_url" value="{{ url(route('payment.callback')) }}">
            <input type="hidden" name="publishable_api_key" value="{{ config('services.moyasar.key') }}">
            <input type="hidden" name="amount" value="{{ $order->total }}">
            <input type="hidden" name="source[type]" value="craditcard">
            <input type="hidden" name="description" value="{{ __('anythings') }}">
            <input type="text" name="source[name]">
            <input type="text" name="source[number]">
            <input type="text" name="source[month]">
            <input type="text" name="source[year]">
            <input type="text" name="source[cvc]">
            <button type="submit" class="btn btn-drk"> {{ __('purchase') }} </button>
        </form>
    </div>
@endsection
