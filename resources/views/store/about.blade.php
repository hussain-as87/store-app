@extends('layouts.store_layout')
@section('title')
{{__('about')}}
@endsection
@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('images/bg-02.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        {{ __('About') }}
    </h2>
</section>


<!-- Content page -->
   <section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        {{__('Our Story')}}
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        {!! $about->story !!}
                    </p>
                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1 ">
                    <div class="hov-img0">
                        <img src="{{ asset('storage/images/about/'.$about->story_image) }}" alt="IMG">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        {{__('Our Mission')}}
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                       {!! $about->service !!}
                        </span>
                </div>
            </div>
        </div>

        <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
            <div class="how-bor2">
                <div class="hov-img0">
                    <img src="{{ asset('storage/images/about/'.$about->service_image) }}" alt="IMG">
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@endsection
