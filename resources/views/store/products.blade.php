@extends('layouts.store_layout')
@section('title')
    {{__('contact')}}
@endsection
@section('content')
    @push('links')
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
        <!--===============================================================================================-->
    @endpush
    <br>
    <br>
    <br>
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <livewire:products-filter/>

        </div>
    </div>

@endsection
