@extends('layouts.store_layout')
@section('title')
{{$category->name}}
@endsection
@section('links')
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
<!-- Custom-->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
<div class="ps-blog-grid pt-80 pb-80">
    <div class="ps-container">
        <div class="row">
            @foreach ($products as $pro)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="ps-post mb-30">
                    <div class="ps-post__thumbnail"><a class="ps-post__overlay" href="{{route('store.product.show',$pro->id)}}"></a><img src="{{asset('storage/products/'.$pro->image)}}" alt=""></div>
                    <div class="ps-post__content"><a class="ps-post__title" href="{{route('store.product.show',$pro->id)}}">{{ $pro->name }}</a>
                        <p class="ps-post__meta"><span>By:<a class="mr-5" href="blog.html">{{ $pro->user->name }}</a></span> -<span class="ml-5">{{ $pro->created_at->format('M d, Y') }}</span></p>
                        <a class="ps-morelink" href="{{route('store.product.show',$pro->id)}}">Read more<i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="mt-30" style="text-align: center;">

            {{$products->links()}}

        </div>
    </div>
</div>
@section('scripts')
<script type="text/javascript" src="{{ asset('plugins/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/gmap3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/imagesloaded.pkgd.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery.matchHeight-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/slick/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/elevatezoom/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
<script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="{{ asset('plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<!-- Custom scripts-->
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
@endsection
@endsection
