<div>
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
                               <th class="text-uppercase" style="color: white">Product</th>
                               <th class="text-uppercase" style="color: white">Total</th>
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
