@extends('layouts.store_layout')
@section('title','cart')
@section('content')
    <div class="ps-content pt-80 pb-80">
        <div class="ps-container">
            <div class="ps-cart-listing">
                <table class="table ps-cart__table">
                    <thead>
                    <tr>
                        <th>All Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--cart--}}
                    @php
                        $total=0;
                    @endphp
                    @foreach ($order as $item)
                        <tr>
                            <td><a class="ps-product__preview" href="{{--{{route('store.product.show',$item->product_id)}}--}}"><img
                                        class="mr-15"
                                        src="{{--{{asset('storage/products/'.$item->product->image)}}--}}"
                                        alt="" width="200"> air jordan One
                                    mid</a></td>
                            <td>${{$item->price}}</td>
                            <td>
                                <div class="form-group--number">
                                    <button class="minus"><span>-</span></button>
                                    <input class="form-control" type="text" value="{{$item->quantity}}">
                                    <button class="plus"><span>+</span></button>
                                </div>
                            </td>
                            <td>${{$item->price * $item->quantity}}</td>
                            <td>
                                <div class="ps-remove"></div>
                            </td>
                        </tr>
                        @php
                            $total += $item->price * $item->quantity;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
                <div class="ps-cart__actions">
                    <div class="ps-cart__promotion">
                        <div class="form-group">
                            <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                                <input class="form-control" type="text" placeholder="Promo Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="ps-btn ps-btn--gray">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="ps-cart__total">
                        <h3>Total Price: <span> {{$total}} $</span></h3><a class="ps-btn" href="checkout.html">Process
                            to
                            checkout<i class="ps-icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
