<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7"><![endif]-->
<!--[if IE 8]>
<html class="ie ie8"><![endif]-->
<!--[if IE 9]>
<html class="ie ie9"><![endif]-->
<html lang="en">
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- dir="{{ config('locales.languages')[app()->getLocale()]['rtl_support'] }}" --}}>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('favicon.png') }}" rel="icon">
    <meta name="author" content="Nghia Minh Luong">
    {{-- <meta name="csrf-token" content="{{csrf_token()}}"> --}}
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">
    <title>@yield('title')</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/ps-icon/style.css') }}">
    <!-- CSS Library-->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Magnific-Popup/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/revolution/css/navigation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    @livewireStyles
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Custom-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
    svg:hover{
        color: #ffb100;
    }
</style>
    {{-- @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')


    <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css" integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">

    @endif --}}
</head>
<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10">
    <![endif]-->
<!--[if IE 8]>
    <body class="ie8 lt-ie9 lt-ie10">
        <![endif]-->
<!--[if IE 9]>
        <body class="ie9 lt-ie10">
            <![endif]-->

<body class="ps-loading">
    <div class="header--sidebar"></div>
    <header class="header">
        <div class="header__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                        <p>460 West 34th Street, 15th floor, New York - Hotline: 804-377-3580 - 804-399-3580</p>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                        <div class="header__actions">
                            <div class="btn-group ps-dropdown " style="background-color: #ffd0d4!important">
                                @auth
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                                             document.getElementById('logout-form').submit();">
                                    {{ __('logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @endauth
                            </div>
                            <div class="btn-group ps-dropdown">
                                <!-- Authentication Links -->
                                @guest
                                @if (Route::has('login'))
                                <a class="nav-link " style="background-color: #b8dee4!important;" href="{{ route('login') }}">{{ __('login') }}</a>
                                @endif
                                @if (Route::has('register'))
                                <a class="btn btn-outline-info" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                @endif

                                @else
                                <a class="nav-link">
                                    {{ Auth::user()->name }}
                                </a>
                                @endguest
                            </div>
                            <div class="btn-group ps-dropdown">
                                @foreach (config('locales.languages') as $key => $val)
                                @if ($key != app()->getLocale())
                                <a href="{{ route('change.language', __($key)) }}">{{ __($val['name']) }}
                                    <i class="flag-icon flag-icon-{{ __($val['icon']) }}" title="{{ $key }}" id="{{ $key }}"></i></a>
                                @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <nav class="navigation">
            <div class="container-fluid">
                <div class="navigation__column left">
                    <div class="header__logo"><a class="ps-logo" href="{{ route('store.home') }}"><img src="{{ asset('images/logo.png') }}" alt=""></a></div>
                </div>
                <div class="navigation__column center">
                    <ul class="main-menu menu">
                        <li class="menu-item menu-item-has-children dropdown"><a href="{{ route('store.home') }}">{{ __('Home') }}</a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="{{ route('store.home') }}">Homepage #1</a></li>
                                <li class="menu-item"><a href="{{ route('store.home') }}">Homepage #2</a></li>
                                <li class="menu-item"><a href="{{ route('store.home') }}">Homepage #3</a></li>
                            </ul>
                        </li>
                        <?php $categories = \App\Models\Admin\Category::with('subcategories')->get(); ?>
                        @foreach ($categories as $category)
                        <li class="menu-item menu-item-has-children has-mega-menu"><a href="#">{{ $category->name }}</a>
                            <div class="mega-menu">
                                <div class="mega-wrap">
                                    @if ($category->subcategories)
                                    @foreach ($category->subcategories as $sub)
                                    <div class="mega-column">
                                        <ul class="mega-item mega-features">
                                            <li><a href="product-listing.html">NEW RELEASES</a></li>
                                            <li><a href="product-listing.html">FEATURES SHOES</a></li>
                                            <li><a href="product-listing.html">BEST SELLERS</a></li>
                                            <li><a href="product-listing.html">NOW TRENDING</a></li>
                                            <li><a href="product-listing.html">SUMMER ESSENTIALS</a></li>
                                            <li><a href="product-listing.html">MOTHERS DAY COLLECTION</a>
                                            </li>
                                            <li><a href="product-listing.html">FAN GEAR</a></li>
                                        </ul>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="navigation__column right">
                    <form class="ps-search--header" action="{{ route('store.product.search') }}" method="POST">
                        @csrf
                        <input class="form-control" type="text" placeholder="{{ __('search') }}" name="search_value">
                        <button type="submit"><i class="ps-icon-search"></i></button>
                    </form>
                    @php
                    $total=0;
                    @endphp

                    <form action="{{route('checkout.store')}}" method="post">
                        @csrf
                        <div class="ps-cart"><a class="ps-cart__toggle" href="#"><span><i>{{ $item_count }}</i></span><i class="ps-icon-shopping-cart"></i></a>
                            <div class="ps-cart__listing">
                                <div class="ps-cart__content">
                                    @foreach ($cart as $item)
                                    <div class="ps-cart-item"><a class="ps-cart-item__close" href="#"></a>
                                        <div class="ps-cart-item__thumbnail"><a href="product-detail.html"></a><img src="{{ asset('images/cart-preview/1.jpg') }}" alt=""></div>
                                        <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="product-detail.html">{{$item->product->name}}</a>
                                            <p><span>Quantity:<i>{{$item['quantity']}}</i></span><span>T otal:<i>£{{$item['price'] * $item['quantity']}}</i></span></p>
                                        </div>
                                    </div>
                                    @php
                                    $total += $item['price'] *$item['quantity']
                                    @endphp
                                    @endforeach
                                </div>
                                <div class="ps-cart__total">
                                    <p>Number of items:<span>{{ $item_count }}</span></p>
                                    <p>Item Total:<span>£{{ $total }}</span></p>
                                </div>
                                <div class="ps-cart__footer"><button class="ps-btn" href="cart.html" type="submit">{{ __('Check out') }}<i class="ps-icon-arrow-left"></i></button></div>

                            </div>
                        </div>


                    </form>

                    <div class="menu-toggle"><span></span></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="header-services">
        <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>{{__('Free delivery')}}</strong>: {{__('Get free standard delivery on every order with') ." ". env('APP_NAME')}}</p>
        </div>
        <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>{{__('Free delivery')}}</strong>: {{__('Get free standard delivery on every order with') ." ". env('APP_NAME')}}</p>
        </div>
        <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>{{__('Free delivery')}}</strong>: {{__('Get free standard delivery on every order with') ." ". env('APP_NAME')}}</p>
        </div>
    </div>
    <main class="ps-main">
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

        @yield('content')
        <div class="ps-subscribe">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">
                        <h3><i class="fa fa-envelope"></i>{{ __('Sign up to Newsletterw') }}</h3>
                    </div>
                    <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 ">
                        <form class="ps-subscribe__form" action="do_action" method="post">
                            <input class="form-control" type="text" placeholder="">
                            <button>{{ __('Sign up now') }}</button>
                        </form>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                        <p>{{ __('...and receive') }} <span>$20</span> {{ __('coupon for first shopping.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-footer bg--cover" data-background="{{ asset('images/background/parallax.jpg') }}">
            <div class="ps-footer__content">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--info">
                                <header><a class="ps-logo" href="{{ route('store.home') }}"><img src="{{ asset('images/logo-white.png') }}" alt=""></a>
                                    <h3 class="ps-widget__title">{{ __('Address Office 1') }}</h3>
                                </header>
                                <footer>
                                    <p><strong>460 West 34th Street, 15th floor, New York</strong></p>
                                    <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                    <p>Phone: +323 32434 5334</p>
                                    <p>Fax: ++323 32434 5333</p>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--info second">
                                <header>
                                    <h3 class="ps-widget__title">{{ __('Address Office 2') }}</h3>
                                </header>
                                <footer>
                                    <p><strong>PO Box 16122 Collins Victoria 3000 Australia</strong></p>
                                    <p>Email: <a href='mailto:support@store.com'>support@store.com</a></p>
                                    <p>Phone: +323 32434 5334</p>
                                    <p>Fax: ++323 32434 5333</p>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">{{ __('Find Our store') }}</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--link">
                                        <li><a href="#">{{ __('Coupon Code') }}</a></li>
                                        <li><a href="#">{{ __('SignUp For Email') }}</a></li>
                                        <li><a href="#">{{ __('Site Feedback') }}</a></li>
                                        <li><a href="#">{{ __('Careers') }}</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">{{ __('Get Help') }}</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--line">
                                        <li><a href="#">{{ __('Order Status') }}</a></li>
                                        <li><a href="#">{{ __('Shipping and Delivery') }}</a></li>
                                        <li><a href="#">{{ __('Returns') }}</a></li>
                                        <li><a href="#">{{ __('Payment Options') }}</a></li>
                                        <li><a href="#">{{ __('Contact Us') }}</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">{{ __('Products') }}</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--line">
                                        <li><a href="#">Shoes</a></li>
                                        <li><a href="#">Clothing</a></li>
                                        <li><a href="#">Accessries</a></li>
                                        <li><a href="#">Football Boots</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-footer__copyright">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <p>&copy; <a href="{{ route('store.home') }}">{{ __(env('APP_NAME')) }}</a>,
                                {{ __('All rights reserved.') }}
                                .</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <ul class="ps-social">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    @livewireScripts

    <!-- JS Library-->
    <script type="text/javascript" src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/gmap3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/imagesloaded.pkgd.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/isotope.pkgd.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('plugins/jquery.matchHeight-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/slick/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/elevatezoom/jquery.elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
    <script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="{{ asset('plugins/revolution/js/jquery.themepunch.revolution.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.video.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <!-- Custom scripts-->
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        var userid = {
            {
                auth() - > id()
            }
        }

    </script>
    <script>
        function scrollDown() {
            document.getElementById('chat_box').scrollTop = document.getElementById('chat_box').scrollHeight
        }
        setInterval(scrollDown, 1000000)

    </script>

</body>

</html>
