@if($product)
<div class="minipopup-box show" style="top: 0px;">
    <div class="product product-list-sm  product-cart">
        <figure class="product-media">
            <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}">
            <img src="{{asset($product->image())}}" alt="{{$product->name}}" width="80" height="90">
            </a>
        </figure>
        <div class="product-details">
            <h4 class="product-name">
                <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}">{{$product->name}}</a>
            </h4>
            <p>has been added to cart:</p>
        </div>
    </div>
    <div class="product-action">
        <a href="{{route('carts')}}" class="btn btn-rounded btn-sm">View Cart</a>
        <a href="{{route('checkout')}}" class="btn btn-dark btn-rounded btn-sm">Checkout</a>
    </div>
</div>
@endif