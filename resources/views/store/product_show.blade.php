@extends('layouts.store_layout')
@section('title')
    {{$product->name}}
@endsection
@section('content')
    @push('links')
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
        <!--===============================================================================================-->
    @endpush
    <br/>
    <br/>


    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('store.home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ __('Home') }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('store.shop') }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product->category->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
            {{$product->name}}
        </span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{asset('storage/products/'.$product->image)}}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{asset('storage/products/'.$product->image)}}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                           href="{{asset('storage/products/'.$product->image)}}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                @foreach ($product->product_images as $image)
                                    <div class="item-slick3" data-thumb="{{asset('storage/'.$image->path)}}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{asset('storage/'.$image->path)}}" alt="IMG-PRODUCT">

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

                        <p class="stext-102 cl3 p-t-23">
                        </p>
                        <form action="{{route('cart.store')}}" method="post" id="appCart">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">


                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        {{ __('Size') }}
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="size">
                                                <option>{{ __('Choose an option') }}</option>
                                                <option value="s">{{ __('size') }} S</option>
                                                <option value="m">{{ __('size') }} M</option>
                                                <option value="l">{{ __('size') }} L</option>
                                                <option value="xl">{{ __('size') }} XL</option>
                                                <option value="xxl">{{ __('size') }} XXL</option>
                                                <option value="xxxl">{{ __('size') }} XXXL</option>
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
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                   name="quantity" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
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

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                               data-tooltip="Favorite">
                                <livewire:favorite-product-home :product="$product"/>
                            </a>

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

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description"
                               role="tab">{{__('description')}}</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">{{__('Additional')}}
                                information</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">{{__('Reviews')}} (1)</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            Weight
                                        </span>

                                            <span class="stext-102 cl6 size-206">
                                            0.79 kg
                                        </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            {{__('Dimensions')}}
                                        </span>

                                            <span class="stext-102 cl6 size-206">
                                            110 x 33 x 100 cm
                                        </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            {{__('Materials')}}
                                        </span>

                                            <span class="stext-102 cl6 size-206">
                                            60% cotton
                                        </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            {{__('Color')}}
                                        </span>

                                            <span class="stext-102 cl6 size-206">
                                            {{__('Black, Blue, Grey, Green, Red, White')}}
                                        </span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
                                        <span class="stext-102 cl3 size-205">
                                            {{__('Size')}}
                                        </span>

                                            <span class="stext-102 cl6 size-206">
                                            XL, L, M, S
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        <div class="flex-w flex-t p-b-68">
                                            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                <img src="{{asset('images/avatar-01.jpg')}}" alt="AVATAR">
                                            </div>

                                            <div class="size-207">
                                                <div class="flex-w flex-sb-m p-b-17">
                                                <span class="mtext-107 cl2 p-r-20">
                                                    Ariana Grande
                                                </span>

                                                    <span class="fs-18 cl11">
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star"></i>
                                                    <i class="zmdi zmdi-star-half"></i>
                                                </span>
                                                </div>

                                                <p class="stext-102 cl6">
                                                    Quod autem in homine praestantissimum atque optimum est, id
                                                    deseruit. Apud ceteros autem philosophos
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Add review -->
                                        <form class="w-full">
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                {{ __('Add a review') }}
                                            </h5>

                                            <p class="stext-102 cl6">
                                                {{__('Your email address will not be published. Required fields are marked *')}}
                                            </p>

                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                            <span class="stext-102 cl3 m-r-16">
                                                {{__('Your Rating')}}
                                            </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                <input class="dis-none" type="number" name="rating">
                                            </span>
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">{{__('Your review')}}</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10"
                                                              id="review" name="review"></textarea>
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="name">{{__('name')}}</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                           type="text" name="name">
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="email">{{__('email')}}</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email"
                                                           type="text" name="email">
                                                </div>
                                            </div>

                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                {{ __('Submit') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            {{__('product')}}: {{$product->name}}
        </span>

            <span class="stext-107 cl6 p-lr-25">
            {{ __('categories') }}: {{ $product->category->name }}
        </span>
        </div>
    </section>



    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    {{ __('Related Products') }}
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach($propducts_cate as $key => $pro_c)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{asset('storage/products/'.$pro_c->image)}}" alt="IMG-PRODUCT">

                                    <a href="#"
                                       class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        {{__('Quick View')}}
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{route('store.product.show',$pro_c->id)}}"
                                           class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{$pro_c->name}}
                                        </a>

                                        <span class="stext-105 cl3">
                                    ${{$pro_c->price}}
                                </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">

                                        <livewire:favorite-product-home :product="$pro_c"/>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <!--===============================================================================================-->
        <script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
        <!--===============================================================================================-->
        <script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
        <!--===============================================================================================-->
        <script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
        <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <!--===============================================================================================-->

        <!--===============================================================================================-->
        <script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
        <script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
        <!--===============================================================================================-->
        <script src="{{asset('vendor/slick/slick.min.js')}}"></script>
        <script src="{{asset('js/slick-custom.js')}}"></script>
        <!--===============================================================================================-->
        <script src="{{asset('vendor/parallax100/parallax100.js')}}"></script>
        <script>
            $('.parallax100').parallax100();

        </script>
        <!--===============================================================================================-->
        <script src="{{asset('vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
        <script>
            $('.gallery-lb').each(function () { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image'
                    , gallery: {
                        enabled: true
                    }
                    , mainClass: 'mfp-fade'
                });
            });

        </script>
        <!--===============================================================================================-->
        <script src="{{asset('vendor/isotope/isotope.pkgd.min.js')}}"></script>
        <!--===============================================================================================-->
        <!--===============================================================================================-->
        <script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script>
            $('.js-pscroll').each(function () {
                $(this).css('position', 'relative');
                $(this).css('overflow', 'hidden');
                var ps = new PerfectScrollbar(this, {
                    wheelSpeed: 1
                    , scrollingThreshold: 1000
                    , wheelPropagation: false
                    ,
                });

                $(window).on('resize', function () {
                    ps.update();
                })
            });

        </script>
        <!--===============================================================================================-->
        <script src="{{asset('js/main.js')}}"></script>

    @endpush
@endsection
