@extends('layouts.store_layout')
@section('title')
    {{__('search')}}
@endsection
@section('content')
<br />
<br />
<br />


<!-- Product -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
<div class="bg0 m-t-23 p-b-140">
    <div class="container">

        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                    {{ __('All Products') }}
                </button>
                @foreach ($categories as $category)
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $category->name }}">
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
                        <span class="badge badge-success" style="position: absolute;right: 0;top: 0;">{{__('New')}}</span>
                        @endif
                        @if ($new_price!==null)
                        <span class="badge badge-danger" style="position: absolute;right: 0;top: 25px;">-{{ $formatter->format($new_price->percentage) }}</span>
                        @endif
                        <a href="{{route('store.product.show',$product->id)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                            {{__('Quick View')}}
                        </a>
                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="{{route('store.product.show',$product->id)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
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
            @endforeach
        </div>


        <!-- Load more -->
        {{-- <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>  --}}

    </div>
</div>
@endsection
