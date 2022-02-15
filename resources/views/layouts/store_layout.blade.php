<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- dir="{{ config('locales.languages')[app()->getLocale()]['rtl_support'] }}" --}}>
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href={{asset('vendor/bootstrap/css/bootstrap.min.css')}}>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/MagnificPopup/magnific-popup.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    @livewireStyles
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <style>
        svg:hover {
            color: #ffb100;
        }

    </style>
    @stack('links')

    {{-- @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')


    <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css" integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">

    @endif --}}
</head>
<body class="animsition">

<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    {{__('Free shipping for standard order over $100')}}
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        {{__('Help & FAQs')}}
                    </a>
                    @auth

                        <a class="flex-c-m trans-04 p-lr-25" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                                                 document.getElementById('logout-form').submit();">
                            {{ __('logout') }}
                        </a>
                        <a class="flex-c-m trans-04 p-lr-25" style="color: #e9e9e9">
                            {{ auth()->user()->name }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                    @guest
                        @if (Route::has('login'))
                            <a class="flex-c-m trans-04 p-lr-25" href="{{ route('login') }}">{{ __('login') }}</a>
                            @if (Route::has('register'))
                                <a class="flex-c-m trans-04 p-lr-25"
                                   href="{{ route('register') }}">{{ __('Sign up') }}</a>
                            @endif
                        @endif

                    @endguest
                    @foreach (config('locales.languages') as $key => $val)
                        @if ($key != app()->getLocale())
                            <a href="{{ route('change.language', __($key)) }}"
                               class="flex-c-m trans-04 p-lr-25">{{ __($val['name']) }}
                                <i class="flag-icon flag-icon-{{ __($val['icon']) }}" title="{{ $key }}"
                                   id="{{ $key }}"></i></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <!-- Logo desktop -->
                <a href="{{route('store.home')}}" class="logo">
                    <img src="{{ asset(config('settings.logo')) }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class=" {{ Request::segment(1) === null ? 'active-menu' : '' }}">
                            <a href="{{ route('store.home') }}">{{ __('Home') }}</a>
                        </li>

                        <li class=" {{ Request::segment(1) === 'shop' ? 'active-menu' : '' }}">
                            <a href="{{ route('store.shop') }}">{{ __('Shop') }}</a>
                        </li>

                        <li class="label1  {{ Request::segment(1) === 'cart' ? 'active-menu' : '' }}" data-label1="hot">
                            <a href="{{ route('cart.index') }}">{{ __('Features') }}</a>
                        </li>

                        <li class=" {{ Request::segment(1) === 'about' ? 'active-menu' : '' }}">
                            <a href="{{ route('store.about') }}">{{ __('About') }}</a>
                        </li>

                        <li class=" {{ Request::segment(1) === 'contact' ? 'active-menu' : '' }}">
                            <a href="{{ route('store.contact') }}">{{ __('Contact') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                         data-notify="@auth
                         {{$item_count}}
                         @endauth">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <?php $fav_count = \App\Models\favoriteProduct::where('user_id', auth()->id())->count(); ?>
                    <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                       data-notify="@auth
                       {{$fav_count}}
                       @endauth ">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{route('store.home')}}"><img src="{{__('images/icons/logo-01.png')}}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                 data-notify="@auth{{$item_count}} @endauth">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
               data-notify="@auth{{$fav_count}} @endauth">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    {{__('Free shipping for standard order over $100')}}
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">

                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        {{__('Help & FAQs')}}
                    </a>
                    @auth
                        <a class="flex-c-m p-lr-10 trans-04" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                                                 document.getElementById('logout-form').submit();">
                            {{ __('logout') }}
                        </a>
                        <a class="flex-c-m p-lr-10 trans-04" style="color: #e9e9e9">
                            {{ auth()->user()->name }}
                        </a>
                        <form id=" logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                    @guest
                        @if (Route::has('login'))
                            <a class="flex-c-m p-lr-10 trans-04" href="{{ route('login') }}">{{ __('login') }}</a>
                            @if (Route::has('register'))
                                <a class="flex-c-m p-lr-10 trans-04"
                                   href="{{ route('register') }}">{{ __('Sign up') }}</a>
                            @endif
                        @endif

                    @endguest
                    @foreach (config('locales.languages') as $key => $val)
                        @if ($key != app()->getLocale())
                            <a href="{{ route('change.language', __($key)) }}"
                               class="flex-c-m p-lr-10 trans-04">{{ __($val['name']) }}
                                <i class="flag-icon flag-icon-{{ __($val['icon']) }}" title="{{ $key }}"
                                   id="{{ $key }}"></i></a>
                        @endif
                    @endforeach
                </div>

            </li>
        </ul>

        <ul class="main-menu-m">
            <li class="active-menu">
                <a href="{{ route('store.home') }}">{{ __('Home') }}</a>
            </li>

            <li>
                <a href="{{ route('store.shop') }}">{{ __('Shop') }}</a>
            </li>

            <li class="label1" data-label1="hot">
                <a href="{{ route('cart.index') }}">{{ __('Features') }}</a>
            </li>

            <li>
                <a href="{{ route('store.about') }}">{{ __('About') }}</a>
            </li>

            <li>
                <a href="{{ route('store.contact') }}">{{ __('Contact') }}</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{asset('images/icons/icon-close2.png')}}" alt="CLOSE">
            </button>
            <form class="wrap-search-header flex-w p-l-15" action="{{ route('store.product.search') }}" method="POST">
                @csrf
                <button class="flex-c-m trans-04" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" placeholder="{{ __('search') }}" name="search_value">
            </form>
        </div>
    </div>
</header>


<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    {{__('Your Cart')}}
                </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>
        @php
            $total=0;
        @endphp
        <form action="{{route('checkout.store')}}" method="post">
            @csrf
            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full">
                    @auth


                        @foreach ($cart as $item)
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-img">
                                    <img src="{{asset('storage/products/'.$item->product->image)}}" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt p-t-8">
                                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        {{$item->product->name}}
                                    </a>
                                    <span class="header-cart-item-info">
                                    {{$item['quantity']}} x ${{$item['price']}}= <b
                                            class="bg-auto">{{$item['price'] * $item['quantity']}}</b>
                                </span>
                                </div>
                            </li>

                            @php
                                $total += $item['price'] *$item['quantity']
                            @endphp
                        @endforeach

                    @endauth
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        {{__('Total')}}: ${{ $total }}
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="{{route('cart.index')}}"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            {{__('View Cart')}}
                        </a>

                        <button type="submit"
                                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            {{__('Check Out')}}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@yield('content')

<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    {{__('categories')}}
                </h4>
                @php
                    $cs = \App\Models\Admin\Category::orderByDesc('updated_at')->paginate(4);
                @endphp
                <ul>
                    @foreach($cs as $c)
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                {{$c->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    {{__('Get Help')}}
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            {{__('Order Status')}}
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            {{__('Shipping and Delivery')}}
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            {{__('Returns')}}
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            {{__('Payment Options')}}
                        </a>
                    </li>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            {{__('Contact Us')}}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    {{__('GET IN TOUCH')}}
                </h4>

                <p class="stext-107 cl7 size-201">
                    {{__('Any questions? Let us know in-store on the 8th floor, 379 Hudson St, New York, NY 10018, or call us on')}}
                    <br> {{ config('settings.mobile') }}
                </p>

                <div class="p-t-27">
                    <a href="{{ config('settings.facebook') }}" class="fs-18 cl7 hov-cl1 trans-0f4 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="{{ config('settings.instagram') }}" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                </div>
            </div>

        <!--            <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        {{__('Newsletter')}}
            </h4>

            <form>
                <div class="wrap-input1 w-full p-b-4">
                    <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
                           placeholder="email@example.com">
                    <div class="focus-input1 trans-04"></div>
                </div>

                <div class="p-t-18">
                    <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
{{__('Subscribe')}}
            </button>
        </div>
    </form>-->
        </div>
    </div>

    <div class="p-t-40">
        <div class="flex-c-m flex-w p-b-18">
            <a href="#" class="m-all-1">
                <img src="{{asset('images/icons/icon-pay-01.png')}}" alt="ICON-PAY">
            </a>

            <a href="#" class="m-all-1">
                <img src="{{asset('images/icons/icon-pay-02.png')}}" alt="ICON-PAY">
            </a>

            <a href="#" class="m-all-1">
                <img src="{{asset('images/icons/icon-pay-03.png')}}" alt="ICON-PAY">
            </a>

            <a href="#" class="m-all-1">
                <img src="{{asset('images/icons/icon-pay-04.png')}}" alt="ICON-PAY">
            </a>

            <a href="#" class="m-all-1">
                <img src="{{asset('images/icons/icon-pay-05.png')}}" alt="ICON-PAY">
            </a>
        </div>

        <p class="stext-107 cl6 txt-center">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            {{__('Copyright')}} &copy;<script>
                document.write(new Date().getFullYear());

            </script>
            {{__('All rights reserved')}} <i class="fa fa-heart-o" aria-hidden="true"></i>

            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

        </p>
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
</div>


@stack('scripts')
<!--===============================================================================================-->
<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<script>
    $(".js-select2").each(function () {
        $(this).select2({
            minimumResultsForSearch: 20
            , dropdownParent: $(this).next('.dropDownSelect2')
        });
    });
    $(".js-select3").each(function () {
        $(this).select3({
            minimumResultsForSearch: 20
            , dropdownParent: $(this).next('.dropDownSelect3')
        });
    });
    $(".js-select4").each(function () {
        $(this).select4({
            minimumResultsForSearch: 20
            , dropdownParent: $(this).next('.dropDownSelect4')
        });
    });

</script>
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
<script src="vendor/{{asset('MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
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
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
<script>
    $('.js-addwish-b2').on('click', function (e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function () {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function () {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function () {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function () {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function () {
            swal(nameProduct, "is added to cart !", "success");
        });
    });

</script>
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
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

@livewireScripts
</body>
</html>
