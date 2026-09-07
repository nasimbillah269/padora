<div class="productGrid">
    @if ($product->discountPercent() > 0 )
    <div class="dBdg"><span>{{$product->discountPercent()}}% off</span></div>
    @endif
    <div class="productImgDiv">
        <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" style="display:block;"><img src="{{asset($product->image())}}" alt="AJL Sea Food" /></a>
    </div>
    <!--<a href="javascript:void(0)" data-id="{{$product->id}}" data-url="{{route('wishlistCompareUpdate',[$product->id,'wishlist'])}}" title="Add to wishlist" class="wishList {{$product->isWl()?'active':''}} btn-wishlist">-->
    <!--    <span class="load-more-overlay" style="top: 7px;"></span>-->
    <!--    <i class="fa fa-heart-o" aria-hidden="true"></i>-->
    <!--    </a>-->
    <div class="productContent">
        
        <div class="cardBtn">
   

    <!-- View / Quick View Icon Button -->
    <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" title="View Details" class="viewBtn"><i class="fa-custom-view-img"></i></a>
    <span>|</span>
     <!-- Add to Cart Icon Button -->
   <a href="javascript:void(0)" data-id="{{$product->id}}" data-url="{{route('addToCart',$product->id)}}" title="Add to cart" onclick="addToCart({{ json_encode($product) }})" class="addcart btn-cart "><span class="load-more-overlay"></span><i class="fa-solid fa-cart-shopping"></i></a>
</div>
        
        
        <a href="{{route('productView',$product->slug?:Str::slug($product->name))}}" class="proTitle">{{Str::limit($product->name,25)}}</a>
        <!--<div class="rating">-->
        <!--    <i class="fa fa-star" aria-hidden="true"></i>-->
        <!--    <i class="fa fa-star" aria-hidden="true"></i>-->
        <!--    <i class="fa fa-star" aria-hidden="true"></i>-->
        <!--    <i class="fa fa-star" aria-hidden="true"></i>-->
        <!--    <i class="fa fa-star" aria-hidden="true"></i>-->
        <!--    <span>(5)</span>-->
        <!--</div>-->
        <p class="price"><span> {{priceFullFormat($product->offerPrice())}} @if($product->regular_price > $product->offerPrice())<del>{{priceFullFormat($product->regular_price)}}</del>@endif</span></p>
        <!--<a href="javascript:void(0)" data-id="{{$product->id}}" data-url="{{route('addToCart',$product->id)}}" title="Add to cart" onclick="addToCart({{ json_encode($product) }})" class="addcart btn-cart "><span class="load-more-overlay"></span>Add To Cart</a>-->
    </div>
</div>