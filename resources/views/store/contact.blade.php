@extends('layouts.store_layout')
@section('title')
    {{__('contact')}}
@endsection
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
             style="background-image: url('{{ asset('images/bg-04.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center text-dark">
            {{__('Contact')}}
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form action="{{route('store.contact.store')}}" method="post">
                        @csrf
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            {{__('Send Message')}}
                        </h4>


                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input
                                class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30 @error('email') is-invalid alert-danger @enderror"
                                type="text" name="email" placeholder="{{__('email')}}">
                            <img class="how-pos4 pointer-none" src="{{ asset('images/icons/icon-email.png') }}"
                                 alt="ICON">
                        </div>
                        <div class="bor8 m-b-30">
                            <textarea
                                class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25 @error('message') is-invalid alert-danger @enderror"
                                name="message" placeholder="{{__('Message')}}"></textarea>
                        </div>
                        <button type="submit"
                                class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            {{__('submit')}}
                        </button>
                    </form>
                </div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                    <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                        <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            {{ __('ADDRESS') }}
                        </span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                {{ __(config('settings.address')) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                        <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            {{ __('Lets Talk') }}
                        </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                {{config('settings.mobile')}}
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                        <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            {{ __('Sale Support') }}
                        </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                {{config('settings.email')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Map -->
    {{-- <div class="map">
        <div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
    </div>  --}}


@endsection
