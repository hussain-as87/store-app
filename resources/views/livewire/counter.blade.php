<div wire:poll.750ms>
    <div class="row" wire:model="dataOfText">
        <div class="ps-cart-listing col-md-8">
            <table class="table ps-cart__table">
                <thead>
                    <tr>
                        <th>{{ __('All Products') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{--cart--}}
                    @php
                    $total=0;

                    @endphp
                    @foreach ($cart as $item)
                    <tr>
                        <td><a class="ps-product__preview" href="{{route('store.product.show',$item->product_id)}}"><img class="mr-15" src="{{asset('storage/products/'.$item->product->image)}}" alt="" width="90"> air jordan One
                                mid</a></td>
                        <td>${{$item['price']}}</td>
                        <td>
                            <div class="form-group--number">
                                <button class="minus" wire:click="minus({{ $item->product_id  }})"><span>-</span></button>
                                <input class="form-control" type="text" value="{{ $item->quantity}}">
                                <button class="plus" wire:click="plus({{ $item->product_id  }})"><span>+</span></button>
                            </div>
                        </td>
                        <td>${{$item['price'] * $item['quantity'] }}</td>


                        <td>
                            <a wire:click="destroy({{ $item->product_id }})"><i class="ps-remove"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <form class="ps-checkout__form" action="{{route('checkout.store')}}" method="post">
                @csrf

                <div class=" " {{-- style="position: relative;
                              right: -318px;" --}}>

                    <div class="ps-checkout__order" {{--  style="width: 500px;text-align: center;" --}}>


                        <header>
                            <h3>Your Order</h3>
                        </header>
                        <div class="content">
                            <table class="table ps-checkout__products">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase" style="color: white">{{ __('products') }}</th>
                                        <th class="text-uppercase" style="color: white">{{ __('total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($cart as $item)
                                    <tr>
                                        <td style="color: white">{{$item->product->name}}</td>
                                        <td style="color: white">{{$item['price'] * $item['quantity']}}</td>

                                    </tr>
                                    @php
                                    $total += $item['price'] *$item['quantity']
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td style="color: white">{{__('Order Total')}}</td>
                                        <td style="color: white">${{$total}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <footer>
                            <h3>Payment Method</h3>
                            <div class="form-group cheque">
                                <div class="ps-radio">
                                    <input class="form-control" type="radio" id="rdo01" name="payment" checked>
                                    <label for="rdo01">Cheque Payment</label>
                                    <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                </div>
                            </div>
                            <div class="form-group paypal">
                                <div class="ps-radio ps-radio--inline">
                                    <input class="form-control" type="radio" name="payment" id="rdo02">
                                    <label for="rdo02">Paypal</label>
                                </div>
                                <ul class="ps-payment-method">
                                    <li><a href="#"><img src="images/payment/1.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/payment/2.png" alt=""></a></li>
                                    <li><a href="#"><img src="images/payment/3.png" alt=""></a></li>
                                </ul>
                                <button class="ps-btn ps-btn--fullwidth" type="submit">{{__('Place Order')}}<i class="ps-icon-next"></i></button>
                            </div>
                        </footer>
                    </div>
                    <div class="ps-shipping">
                        <h3>FREE SHIPPING</h3>
                        <p>YOUR ORDER QUALIFIES FOR FREE SHIPPING.<br> <a href="#"> Singup </a> for free shipping on every order, every time.</p>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
