@extends('layouts.store_layout')
@section('title')
{{$product->name}}
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
<main class="ps-main">
    <div class="test">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ">
                </div>
            </div>
        </div>
    </div>
    <div class="ps-product--detail pt-60">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-lg-offset-1">
                    <div class="ps-product__thumbnail">
                        <div class="ps-product__preview">
                            <div class="ps-product__variants">
                                @foreach ($product->product_images as $image)
                                <div class="item"><img src="{{asset('storage/'.$image->path)}}" alt=""></div>
                                @endforeach
                            </div><a class="popup-youtube ps-product__video" href="http://www.youtube.com/watch?v=0O2aH4XLbto"><img src="images/shoe-detail/1.jpg" alt=""><i class="fa fa-play"></i></a>
                        </div>
                        <div class="ps-product__image">
                            <div class="item"><img class="zoom" src="{{asset('storage/products/'.$product->image)}}" alt="" data-zoom-image="{{asset('storage/products/'.$product->image)}}"></div>
                        </div>
                    </div>
                    <div class="ps-product__thumbnail--mobile">
                        <div class="ps-product__main-img"><img src="{{asset('storage/products/'.$product->image)}}" alt=""></div>
                        <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="images/shoe-detail/1.jpg" alt=""><img src="images/shoe-detail/2.jpg" alt=""><img src="images/shoe-detail/3.jpg" alt=""></div>
                    </div>
                    <div class="ps-product__info">
                        <livewire:rating-products :product="$product" :key="$product->id">

                            <h1>{{$product->name}}</h1>
                            <p class="ps-product__category"><a href="{{ route('grid.category',$product->category->id) }}"> {{$product->category->name}}</a>,<a href="#"> Jordan</a></p>
                            <h3 class="ps-product__price">@if ($new_price !== null)
                                <h3 class="ps-product__price">£ {{$new_price->price}}
                                    <del>£ {{$product->price}}</del>
                                </h3>
                                @else
                                <h3 class="ps-product__price">£ {{$product->price}}
                                </h3>
                                @endif</h3>
                            <div class="ps-product__block ps-product__quickview">
                                <h4>QUICK REVIEW</h4>
                                <p>The Nike Free RN 2017 Mens Running Sky weighs less than previous versions and features an updated knit material…</p>
                            </div>
                            <div class="ps-product__block ps-product__style">
                                <h4>CHOOSE YOUR STYLE</h4>
                                <ul>
                                    @foreach ($product->product_images as $image)
                                    <li><a href=""><img src="{{asset('storage/'.$image->path)}}" alt=""></a>
                                    </li>
                                    @endforeach


                                </ul>
                            </div>
                            <form action="{{route('cart.store')}}" method="post" id="appCart">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="ps-product__block ps-product__size">
                                    <h4>CHOOSE SIZE<a href="#">Size chart</a></h4>
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="quantity" value="1">
                                    </div>
                                </div>
                            </form>
                            <div class="ps-product__shopping"><a class="ps-btn mb-10" href="#" onclick="document.getElementById('appCart').submit()">Add to cart<i class="ps-icon-next"></i></a>
                                <div class="ps-product__actions">
                                    <form action="{{ route('store.fav.product',$product->id) }}" method="post">
                                        @csrf
                                        <button style="border: none; background: transparent;"><a class="mr-10 @if($favorite !== null)
                        bg-danger
                       @endif"><i class="ps-icon-heart"></i></a></button>
                                    </form>
                                </div>
                            </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="ps-product__content mt-50">
                        <ul class="tab-list" role="tablist">
                            <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Overview</a></li>
                            <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Review</a></li>
                            <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">PRODUCT TAG</a></li>
                            <li><a href="#tab_04" aria-controls="tab_04" role="tab" data-toggle="tab">ADDITIONAL</a></li>
                        </ul>
                    </div>
                    <div class="tab-content mb-60">
                        <div class="tab-pane active" role="tabpanel" id="tab_01">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tab_02">
                            <p class="mb-20">1 review for <strong>Shoes Air Jordan</strong></p>
                            <div class="ps-review">
                                <div class="ps-review__thumbnail"><img src="images/user/1.jpg" alt=""></div>
                                <div class="ps-review__content">
                                    <header>
                                        <select class="ps-rating">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <p>By<a href=""> Alena Studio</a> - November 25, 2017</p>
                                    </header>
                                    <p>Soufflé danish gummi bears tart. Pie wafer icing. Gummies jelly beans powder. Chocolate bar pudding macaroon candy canes chocolate apple pie chocolate cake. Sweet caramels sesame snaps halvah bear claw wafer. Sweet roll soufflé muffin topping muffin brownie. Tart bear claw cake tiramisu chocolate bar gummies dragée lemon drops brownie.</p>
                                </div>
                            </div>
                            <form class="ps-product__review" action="_action" method="post">
                                <h4>ADD YOUR REVIEW</h4>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                        <div class="form-group">
                                            <label>Name:<span>*</span></label>
                                            <input class="form-control" type="text" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Email:<span>*</span></label>
                                            <input class="form-control" type="email" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Your rating<span></span></label>
                                            <select class="ps-rating">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                                        <div class="form-group">
                                            <label>Your Review:</label>
                                            <textarea class="form-control" rows="6"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="ps-btn ps-btn--sm">Submit<i class="ps-icon-next"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tab_03">
                            <p>Add your tag <span> *</span></p>
                            <form class="ps-product__tags" action="_action" method="post">
                                <div class="form-group">
                                    <input class="form-control" type="text" placeholder="">
                                    <button class="ps-btn ps-btn--sm">Add Tags</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tab_04">
                            <div class="form-group">
                                <textarea class="form-control" rows="6" placeholder="Enter your addition here..."></textarea>
                            </div>
                            <div class="form-group">
                                <button class="ps-btn" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
        <div class="ps-container">
            <div class="ps-section__header mb-50">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                        <h3 class="ps-section__title" data-mask="Related item">- YOU MIGHT ALSO LIKE</h3>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="ps-section__content">
                <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                    @foreach($propducts_cate as $key => $pro_c)
                    @if ($pro_c->id !== $product->id)
                    @php
                    $new_p= App\Models\PriceDiscount::where('product_id',$pro_c->id)->first();
                    $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
                    $favo= App\Models\favoriteProduct::where('product_id',$pro_c->id)->where('user_id',auth()->id())->first();

                    @endphp
                    <div class="ps-shoes--carousel" style="    width: 290px;">
                        <div class="ps-shoe">
                            <div class="ps-shoe__thumbnail">
                                @if ( $pro_c->updated_at->format('d') == date('d'))
                                <div class="ps-badge"><span>{{__('New')}}</span></div>
                                @endif
                                @if ($new_price!==null)
                                <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-{{ $formatter->format($new_price->percentage) }}</span></div>
                                @endif
                                <form action="{{ route('store.fav.product',$pro_c->id) }}" method="post">
                                    @csrf
                                    <button style="border: none; background: transparent;">
                                        <a class="ps-shoe__favorite @if($favo !== null)
                                                  bg-danger
                                   @endif"><i class="ps-icon-heart"></i></a></button>
                                </form><img src="{{asset('storage/products/'.$pro_c->image)}}" alt="" width="200"><a class="ps-shoe__overlay" href="{{route('store.product.show',$product->id)}}"></a>
                            </div>
                            <div class="ps-shoe__content">
                                <div class="ps-shoe__variants">
                                    <div class="ps-shoe__variant normal">@foreach ($pro_c->product_images as $image)
                                        <div class="item"><img src="{{asset('storage/'.$image->path)}}" alt=""></div>
                                        @endforeach</div>
                                </div>
                                <div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{route('store.product.show',$product->id)}}">{{ $pro_c->name }}</a>
                                    <p class="ps-shoe__categories"><a href="{{ route('grid.category',$pro_c->category->id) }}">{{ $pro_c->category->name }}</a>,<a href="#">
                                            Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £
                                        @if ($new_p !== null)
                                        {{$new_p->price}}
                                        <del>£ {{$pro_c->price}}</del>
                                        @else
                                        {{$pro_c->price}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
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
