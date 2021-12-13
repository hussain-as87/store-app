@extends('layouts.admin_layout')
@section('header_page')
{{__('edit about')}}
@endsection
@section('title')
{{__('edit about')}}
@endsection
@section('name'){{ __('about') }}@endsection
@section('href'){{ route('about.index') }}@endsection
@section('name2'){{ __('products') }}@endsection
@section('href2'){{ route('products.index') }}@endsection
@section('content')
<div class="container">
    <form action="{{route('about.update')}}" method="post" enctype="multipart/form-data">
        @method('put')
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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach(config('locales.languages') as $key => $val)
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#home{{$key}}">{{__($val['name'])}}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">

            {{--tab start--}}
            @foreach(config('locales.languages') as $key => $val)
            <div id="home{{$key}}" class="container tab-pane {{ $loop->index == 0 ? 'show active' : '' }}" aria-labelledby="{{ $key }}-tab"><br>

                <div class="form-group">
                    <label for="story">{{__('story')}}({{ __($val['name']) }})</label>
                    <textarea placeholder="@error('story.' . $key){{ $message }} @enderror" name="story[{{ $key }}]" class="form-control" rows="10">
                 {!! old('story.' . $key, $about->getTranslation('story', $key)) ?? $about->story !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="story">{{__('service')}}({{ __($val['name']) }})</label>
                    <textarea placeholder="@error('service.' . $key){{ $message }} @enderror" name="service[{{ $key }}]" class="form-control" rows="8">
                 {!! old('service.' . $key, $about->getTranslation('service', $key)) ?? $about->service !!}</textarea>
                </div>
            </div>
            @endforeach
            {{--tab end--}}

            <div class="form-group">
                <label for="story_image">{{__('story image')}}</label>
                <input id="story_image" class="form-control" type="file" name="story_image" value={{ old('story_image') }}>
            </div>

            <div class="form-group">
                <label for="service_image">{{__('service image')}}</label>
                <input id="service_image" class="form-control" type="file" name="service_image" value={{ old('service_image') }}>
            </div>
        </div>
        <a class="btn badge-warning" href="{{route('about.index')}}">{{__('Go Back')}}</a>
        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
    </form>
</div>
@endsection
