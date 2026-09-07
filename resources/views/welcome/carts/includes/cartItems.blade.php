@isset($carts) 
@if($carts->count() > 0)
<div class="col-lg-8 pr-lg-4 mb-6">
    @if(general()->minimum_shopping > 0)
        <div class="freeShipping" style="padding: 10px;border: 1px solid #f1ecec;background: #fedbdb;border-radius: 5px;margin-bottom: 8px;">
            <p>
                @if($cartTotalPrice >= general()->minimum_shopping)
                <b>Congratulations!</b> You got free shipping
                @else
                You're <b>{{priceFullFormat(general()->minimum_shopping - $cartTotalPrice)}}</b> away from free shipping (In Dhaka City)
                @endif
            </p>
            @php
                $perchant =round(($cartTotalPrice / general()->minimum_shopping) * 100);
                if($perchant > 100){
                $perchant   =100;
                }
            @endphp
            <div class="progress" style="background: #fca6a6;">
                <div class="progress-bar" role="progressbar" style="width: {{$perchant}}%;" aria-valuenow="{{$perchant}}" aria-valuemin="0" aria-valuemax="100">{{$perchant}}%</div>
            </div>
        </div>
    @endif
<script>

            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                event: "view_cart",
                ecommerce: {
                    currency: "{{ general()->currency }}", // Currency of the transaction
                    value: {{ $cartTotalPrice}}, 
                    items: [
                        @foreach($carts as $item)
                        {
                            @if($product =$item->product)
                            item_id: "{{ $product->id }}",
                            item_name: "{{ $product->name }}",
                            item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}",
                            item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                            price: "{{ $product->offerPrice() }}",
                            quantity: "{{ $item->quantity }}",
                        
                            @endif
                        }@if(!$loop->last),@endif
                        @endforeach
                    ]
                }
            });
    </script>
    <div class="table-responsive">
        <table class="shop-table cart-table">
            <thead>
                <tr>
                    <th></th>
                    <th class="product-name"><span>Product Name</span></th>
                    <th class="product-price"><span>Price</span></th>
                    <th class="product-quantity"><span>Quantity</span></th>
                    <th class="product-subtotal"><span>Subtotal</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                <tr>
                    <td class="product-thumbnail">
                        <div class="p-relative">
                            @if($product=$cart->product)
                            <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}">
                                <figure>
                                    <img src="{{asset($product->image())}}" alt="{{$product->name}}" />
                                </figure>
                            </a>
                            @endif
                            <button type="button" class="btn btn-close cartUpdate" data-url="{{ route('changeToCart', [$cart, 'delete']) }}"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                    </td>
                    <td class="product-name">
                        @if($product=$cart->product)
                        <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}">
                            {{$product->name}}
                        </a>
                        <br />
                        @endif @if($cart->size)
                        <b>Size:</b> {{$cart->size}} @endif @if($cart->color) <b>Color:</b> {{$cart->color}} @endif
                    </td>
                    <td class="product-price"><span class="amount">{{priceFullFormat($cart->itemprice())}}</span></td>
                    <td class="product-quantity">
                        <div class="input-group">
                            <input class="form-control" value="{{$cart->quantity}}" type="number" min="1" max="100000" />
                            <button type="button" class="quantity-plus w-icon-plus cartUpdate" data-url="{{ route('changeToCart', [$cart, 'increment']) }}">+</button>
                            <button type="button" class="quantity-minus w-icon-minus cartUpdate" data-url="{{ route('changeToCart', [$cart, 'decrement']) }}">-</button>
                        </div>
                    </td>
                    <td class="product-subtotal">
                        <span class="amount">{{priceFullFormat($cart->subtotal())}}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="cart-action mb-6">
        <a href="{{route('index')}}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
    </div>

    <form action="{{route('couponApply')}}" class="coupon mb-4" method="post">
        @csrf
        <h5 class="title coupon-title">Coupon Discount</h5>
        <input type="text" name="coupon_code" value="{{old('coupon_code')}}" class="form-control" placeholder="Enter coupon code here..." required="" />
        <button class="btn btn-dark btn-rounded">Apply Coupon</button>
    </form>
</div>

<div class="col-lg-4 sticky-sidebar-wrapper">
    <div class="pin-wrapper">
        <div class="sticky-sidebar">
            <div class="cart-summary">
                <h3 class="cart-title">Cart Totals</h3>
                <br />
                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                    <label class="ls-25">Subtotal</label>
                    <span>{{priceFullFormat($cartTotalPrice)}}</span>
                </div>
                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                    <label class="ls-25">VAT(+)</label>
                    <span>{{ priceFullFormat($cartTax) }}</span>
                </div>
                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                    <label class="ls-25">Discount(-)</label>
                    <span>{{priceFullFormat($couponDisc)}}</span>
                </div>
                
                <hr class="divider mb-6" />
                <div class="order-total d-flex justify-content-between align-items-center">
                    <label>Total</label>
                    <span class="ls-50">{{priceFullFormat($grandTotal)}}</span>
                </div>
                <a href="{{route('checkout')}}" class="btn btn-block btn-dark btn-icon-right btn-rounded btn-checkout"> Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
@else
<div class="col-lg-12 pr-lg-12 mb-6">
    <div class="emptyCart">
        <p class="text-center">Cart is Empty</p>
    </div>
</div>
@endif @endisset