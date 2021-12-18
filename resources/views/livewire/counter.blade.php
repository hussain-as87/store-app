<div wire:poll.750ms>
    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                {{-- carts products --}}
                <div class="col-lg-10 col-xl-7  col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">{{ __('products') }}</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">{{ __('price') }}</th>
                                    <th class="column-4">{{ __('َِQuantity') }}</th>
                                    <th class="column-5">{{ __('Total') }}</th>
                                </tr>
                                {{--cart--}}
                                @php
                                    $total=0;
                                @endphp
                                @foreach ($cart as $item)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <button type="submit" class="how-itemcart1" style="border:none"
                                                    wire:click="destroy({{ $item->product_id }})">
                                                <img src="{{asset('storage/products/'.$item->product->image)}}"
                                                     alt="IMG">
                                            </button>
                                        </td>
                                        <td class="column-2">{{ $item->product->name }}</td>
                                        <td class="column-3">$ {{ $item->price }}</td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"
                                                     wire:click="minus({{ $item->product_id  }})">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                       value="{{ $item->quantity }}">

                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"
                                                     wire:click="plus({{ $item->product_id  }})">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5">$ {{$item['price'] * $item['quantity'] }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                {{-- checkout form --}}
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">

                        <h4 class="mtext-109 cl2 p-b-5">
                            {{ __('Cart Totals') }}
                        </h4>
                        <div class="flex-w flex-t p-t-0 p-b-40">
                            <form wire:submit.prevent="coupon_check()" method="POST">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text"
                                       wire:model="coupon_code" placeholder="{{ __('cupon code') }}">
                                <button type="submit"
                                        class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    {{ __('Apply coupon') }}
                                </button>
                            </form>
                        </div>
                        <form action="{{route('checkout.store')}}" method="post">
                            @csrf
                            @foreach ($cart as $item)
                                @php
                                    $total += $item['price'] * $item['quantity'];
                                @endphp
                            @endforeach
                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        {{ __('Subtotal') }}:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        $ {{ $total }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        {{ __('discount') }}:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        @php
                                            $formatter = new NumberFormatter('en_US', NumberFormatter::PERCENT);
                                        @endphp
                                        @if(session('coupon_value'))
                                            {{$formatter->format(session('coupon_value')) }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            {{-- <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">
                                    Shipping:
                                </span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <p class="stext-111 cl6 p-t-2">
                                    There are no shipping methods available. Please double check your address, or contact us if you need any help.
                                </p>

                                <div class="p-t-15">
                                    <span class="stext-112 cl8">
                                        Calculate Shipping
                                    </span>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="time">
                                            <option>Select a country...</option>
                                            <option>USA</option>
                                            <option>UK</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>

                                    <div class="bor8 bg0 m-b-12">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                                    </div>

                                    <div class="bor8 bg0 m-b-22">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                    </div>

                                    <div class="flex-w">
                                        <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                            Update Totals
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> --}}

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        {{ __('Total') }}:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        @if(session('coupon_value'))
                                            @php
                                                $total2 = session('coupon_value')*$total;
                                                $final_total=$total-$total2;
                                            @endphp
                                            {{$final_total}} $
                                        @else
                                            {{$total}} $
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <button type="submit"
                                    class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                {{ __('Proceed to Checkout') }}
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
