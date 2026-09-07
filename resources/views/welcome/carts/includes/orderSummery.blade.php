<div class="table-responsive order_table orderSummryTable">
<table class="table">
    <thead>
        <tr>
            <th class="text-left">Product</th>
            <th class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($carts as $cart)
        <tr>
            <td class="text-left">{{$cart->product->name}} 
                    @if($cart->size)
                    <b>Size:</b> {{$cart->size}}
                    @endif
                    @if($cart->color)
                    <b>Color:</b> {{$cart->color}}
                    @endif
                    <span class="product-qty">x {{$cart->quantity}}</span></td>
            <td class="text-right">{{priceFullFormat($cart->subtotal())}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="text-left">SubTotal</th>
            <td class="product-subtotal text-right">{{priceFullFormat($cartTotalPrice)}}</td>
        </tr>
        <tr>
            <th class="text-left">VAT</th>
            <td class="product-subtotal text-right">{{priceFullFormat($cartTax)}}</td>
        </tr>
        <tr>
            <th class="text-left">Shipping
                @if($isDhaka=='no')
                <span style="color: #c1bcbc;">
                    (Cocksheet + courier)
                </span>
                @endif
            </th>
            <td class="product-subtotal text-right">{{priceFullFormat($shippingCharge)}}</td>
        </tr>
        <tr>
            <th class="text-left">Discount</th>
            <td class="text-right">
            {{priceFullFormat($couponDisc)}}
            </td>
        </tr>
        <tr>
            <th class="text-left">Total</th>
            <td class="product-subtotal text-right">{{priceFullFormat($grandTotal)}}</td>
        </tr>
    </tfoot>
</table>
</div>
<div class="payment_method">
    <div class="heading_s1">
        <h4>Payment</h4>
    </div>
    <div class="payment_option">
        <div class="custome-radio">
            <input class="form-check-input" type="radio" name="payment_option" id="handCash" value="handCash" checked="">
            <label class="form-check-label" for="handCash">Cash on Delivery</label>
            @if($isDhaka=='no')
            <p data-method="handCash" class="payment-text mt-2">
                To confirm orders outside Dhaka metro, a 20-30% advance is required. Cash on delivery is available only Dhaka metro area
            </p>
            @else
            <p data-method="handCash" class="payment-text mt-2">You will pay after get your goods items.</p>
            @endif
        </div>
    </div>
</div>
@include(general()->theme.'.layouts.banglaNote')