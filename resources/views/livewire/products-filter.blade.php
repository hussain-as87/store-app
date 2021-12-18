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
            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    {{__('filter')}}
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    {{__('search')}}
                </div>
            </div>

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <div class="bor8 dis-flex p-l-15">
                    <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>

                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" wire:model="search"
                           placeholder="{{__('search')}}">
                </div>
            </div>

            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            {{__('Sort By')}}
                        </div>
                        <div class="rs1-select2 bor8 bg0">
                            <select class="js-select2" wire:moedl="size">
                                <option value="id">{{__('Default')}}</option>
                                <option value="name">{{__('name')}}</option>
                                <option value="created_at">{{__('created at')}}</option>
                                <option value="created_at">{{__('updated at')}}</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>

                    <div class="filter-col2 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            {{__('price')}}
                        </div>
                        <div class="rs1-select2 bor8 bg0">
                            <select class="js-select2" wire:moedl="price_range">
                                <option value="[0,10000000000]">{{__('All')}}</option>
                                <option value="[0 , 50]">$0.00 - $50.00</option>
                                <option value="[50 , 100]">$50.00 - $100.00</option>
                                <option value="[100 , 150]">$100.00 - $150.00</option>
                                <option value="[150 , 200]">$150.00 - $200.00</option>
                                <option value="[200 , 10000000000]">$200.00+</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <!--                        <ul>
                                                    <li class="p-b-6">
                                                        <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                                            All
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            $0.00 - $50.00
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            $50.00 - $100.00
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            $100.00 - $150.00
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            $150.00 - $200.00
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            $200.00+
                                                        </a>
                                                    </li>
                                                </ul>-->
                    </div>

                    <div class="filter-col3 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            {{__('Color')}}
                        </div>
                        <div class="rs1-select2 bor8 bg0">
                            <select class="js-select2" wire:moedl="color_chose">
                                <option value="black">{{__('Black')}}<span class="fs-15 lh-12 m-r-6"
                                                                           style="color: #222;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span></option>
                                <option value="blue">{{__('Blue')}}<span class="fs-15 lh-12 m-r-6"
                                                                         style="color: #4272d7;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span></option>
                                <option value="grey">{{__('Grey')}} <span class="fs-15 lh-12 m-r-6"
                                                                          style="color: #b3b3b3;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span></option>
                                <option value="green">{{__('Green')}}<span class="fs-15 lh-12 m-r-6"
                                                                           style="color: #00ad5f;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span></option>
                                <option value="red">{{__('Red')}} <span class="fs-15 lh-12 m-r-6"
                                                                        style="color: #fa4251;">
                                    <i class="zmdi zmdi-circle"></i>
                                </span></option>
                                <option value="white">{{__('White')}}<span class="fs-15 lh-12 m-r-6"
                                                                           style="color: #aaa;">
                                    <i class="zmdi zmdi-circle-o"></i>
                                </span></option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <!--                        <ul>
                                                    <li class="p-b-6">
                                                        <span class="fs-15 lh-12 m-r-6" style="color: #222;">
                                                            <i class="zmdi zmdi-circle"></i>
                                                        </span>

                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            Black
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
                                                            <i class="zmdi zmdi-circle"></i>
                                                        </span>

                                                        <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                                            Blue
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
                                                            <i class="zmdi zmdi-circle"></i>
                                                        </span>

                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            Grey
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
                                                            <i class="zmdi zmdi-circle"></i>
                                                        </span>

                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            Green
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
                                                            <i class="zmdi zmdi-circle"></i>
                                                        </span>

                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            Red
                                                        </a>
                                                    </li>

                                                    <li class="p-b-6">
                                                        <span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
                                                            <i class="zmdi zmdi-circle-o"></i>
                                                        </span>

                                                        <a href="#" class="filter-link stext-106 trans-04">
                                                            White
                                                        </a>
                                                    </li>
                                                </ul>-->
                    </div>

                    <!--                    <div class="filter-col4 p-b-27">
                                            <div class="mtext-102 cl2 p-b-15">
                                                Tags
                                            </div>

                                            <div class="flex-w p-t-4 m-r&#45;&#45;5">
                                                <a href="#"
                                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                                    Fashion
                                                </a>

                                                <a href="#"
                                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                                    Lifestyle
                                                </a>

                                                <a href="#"
                                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                                    Denim
                                                </a>

                                                <a href="#"
                                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                                    Streetstyle
                                                </a>

                                                <a href="#"
                                                   class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                                    Crafts
                                                </a>
                                            </div>
                                        </div>-->
                </div>
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
                               class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
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
