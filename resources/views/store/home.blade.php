@extends('layouts.store_layout')
@section('title')
    {{__('home')}}
@endsection
@section('content')    @push('links')
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
        <!--===============================================================================================-->
    @endpush
    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                @foreach ($advert as $adv)
                    <div class="item-slick1"
                         style="background-image: url({{ asset('storage/advertis/' . $adv->photo) }});">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="fadeInDown"
                                     data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                {{$adv->title}}
                            </span>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="fadeInUp"
                                     data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        {{ $adv->content }}
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                    <a href="{{ route('store.shop') }}"
                                       class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        {{ __('Shop Now') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Banner -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{ asset('storage/category/'.$category->photo) }}" alt="IMG-BANNER">

                            <a href="{{ route('store.shop') }}"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                {{ $category->name }}
                            </span>

                                    <span class="block1-info stext-102 trans-04">
                                {{ $category->content }}
                            </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        {{ __('Shop Now') }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    {{__('Product Overview')}}
                </h3>
            </div>
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        {{ __('All Products') }}
                    </button>
                    @foreach ($categories as $category)
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                                data-filter=".{{ $category->name }}">
                            {{ $category->name }}
                        </button>
                    @endforeach

                </div>
            </div>

            <div class="row isotope-grid">
                @foreach($products as $key => $product)
                    @php
                        $new_price = App\Models\PriceDiscount::where('product_id', $product->id)->first();
                        $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
                        $favo = App\Models\favoriteProduct::where('product_id', $product->id)->where('user_id', auth()->id())->first();
                    @endphp
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->category->name }}">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">

                                <img src="{{ asset('storage/products/'.$product->image) }}" alt="IMG-PRODUCT">
                                @if ( $product->created_at->format('d') == date('d'))
                                    <span class="badge badge-success"
                                          style="position: absolute;right: 0;top: 0;">{{__('New')}}</span>
                                @endif
                                @if ($new_price!==null)
                                    <span class="badge badge-danger"
                                          style="position: absolute;right: 0;top: 25px;">-{{ $formatter->format($new_price->percentage) }}</span>
                                @endif
                                <a href="{{route('store.product.show',$product->id)}}"
                                   class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 " <!--js-show-modal1-->>
                                    {{__('Quick View')}}
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{route('store.product.show',$product->id)}}"
                                       class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$product->name}}
                                    </a>

                                    <span class="stext-105 cl3">
                            ${{$product->price}}
                        </span>
                                </div>
                                <livewire:favorite-product-home :product="$product">
                            </div>
                        </div>
                    </div>


                    <!-- Modal1 -->
<!--
                    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
                        <div class="overlay-modal1 js-hide-modal1"></div>

                        <div class="container">
                            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                                    <img src="{{asset('images/icons/icon-close.png')}}" alt="CLOSE">
                                </button>

                                <div class="row">
                                    <div class="col-md-6 col-lg-7 p-b-30">
                                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                                            <div class="wrap-slick3 flex-sb flex-w">
                                                <div class="wrap-slick3-dots"></div>
                                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                                <div class="slick3 gallery-lb">
                                                    <div class="item-slick3"
                                                         data-thumb="{{asset('storage/products/'.$product->image)}}">
                                                        <div class="wrap-pic-w pos-relative">
                                                            <img src="{{asset('storage/products/'.$product->image)}}"
                                                                 alt="IMG-PRODUCT">

                                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                               href="{{asset('storage/products/'.$product->image)}}">
                                                                <i class="fa fa-expand"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @foreach ($product->product_images as $image)
                                                        <div class="item-slick3"
                                                             data-thumb="{{asset('storage/'.$image->path)}}">
                                                            <div class="wrap-pic-w pos-relative">
                                                                <img src="{{asset('storage/'.$image->path)}}"
                                                                     alt="IMG-PRODUCT">

                                                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                                   href="{{asset('storage/'.$image->path)}}">
                                                                    <i class="fa fa-expand"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-5 p-b-30">
                                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                                {{ $product->name }}
                                            </h4>

                                            <span class="mtext-106 cl2">
                                    ${{ $product->price }}
                                </span>
                                            <form action="{{route('cart.store')}}" method="post" id="appCart">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product->id}}">


                                                &lt;!&ndash;  &ndash;&gt;
                                                <div class="p-t-33">
                                                    <div class="flex-w flex-r-m p-b-10">
                                                        <div class="size-203 flex-c-m respon6">
                                                            {{__('Size')}}
                                                        </div>

                                                        <div class="size-204 respon6-next">
                                                            <div class="rs1-select2 bor8 bg0">
                                                                <select class="js-select2" name="size">
                                                                    <option>{{ __('Choose an option') }}</option>
                                                                    <option value="S">{{ __('size') }} S</option>
                                                                    <option value="M">{{ __('size') }} M</option>
                                                                    <option value="L">{{ __('size') }} L</option>
                                                                    <option value="Xl">{{ __('size') }} XL</option>
                                                                    <option value="XXL">{{ __('size') }} XXL</option>
                                                                    <option value="XXXL">{{ __('size') }} XXXL</option>
                                                                </select>
                                                                <div class="dropDownSelect2"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-w flex-r-m p-b-10">
                                                        <div class="size-203 flex-c-m respon6">
                                                            {{__('Color')}}
                                                        </div>

                                                        <div class="size-204 respon6-next">
                                                            <div class="rs1-select2 bor8 bg0">
                                                                <select class="js-select2" name="color">
                                                                    <option>{{ __('Choose an option') }}</option>
                                                                    <option value="red">{{ __('Red') }}</option>
                                                                    <option value="yellow">{{ __('Yellow') }}</option>
                                                                    <option value="blue">{{ __('Blue') }}</option>
                                                                    <option value="white">{{ __('White') }}</option>
                                                                    <option value="grey">{{ __('Grey') }}</option>
                                                                </select>
                                                                <div class="dropDownSelect2"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex-w flex-r-m p-b-10">
                                                        <div class="size-204 flex-w flex-m respon6-next">
                                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                                <div
                                                                    class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                                </div>

                                                                <input class="mtext-104 cl3 txt-center num-product"
                                                                       type="number" name="quantity" value="1">

                                                                <div
                                                                    class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                                </div>
                                                            </div>

                                                            <button type="submit"
                                                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                                {{ __('Add to cart') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            &lt;!&ndash;  &ndash;&gt;
                                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                                <div class="flex-m bor9 p-r-10 m-r-11">
                                                    <a href="#"
                                                       class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                                       data-tooltip="Add to Wishlist">
                                                        <i class="zmdi zmdi-favorite"></i>
                                                    </a>
                                                </div>@php
                                                    $social = App\Models\SocialMedia::where('user_id', $product->user_id)->first();
                                                @endphp

                                                <a href="{{$social->facebook}}"
                                                   class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                                   data-tooltip="Facebook">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                                <a href="{{$social->twitter}}"
                                                   class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                                   data-tooltip="Twitter">
                                                    <i class="fa fa-twitter"></i>
                                                </a>

                                                <a href="{{$social->google}}"
                                                   class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                                   data-tooltip="Google Plus">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
-->
                @endforeach
            </div>


            <!-- Load more -->
            {{-- <div class="flex-c-m flex-w w-full p-t-45">
                    <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        Load More
                    </a>
                </div>  --}}

        </div>
    </section>

@endsection
