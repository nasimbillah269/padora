
<style>
  :root{
    --cart-green:#0d4429;
    --cart-green-2:#16281d;
    --cart-gold:#c9932d;
    --cart-gold-d:#a97c22;
    --cart-cream:#faf6ec;
    --cart-tint:#e9f0e4;
    --cart-line:#ece7db;
  }

  /* Sidebar Cart Wrapper */
  .cart-inner{
    background:var(--cart-cream);
    height:100%;
    display:flex;
    flex-direction:column;
  }

  /* ---------------- Header ---------------- */
  .cart_top{
    padding:15px 16px;
    background:var(--cart-cream);
    border-bottom:1px solid var(--cart-line);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
  }
  .cart_top .continue-shopping{
    display:inline-flex;
    align-items:center;
    gap:6px;
    color:var(--cart-green);
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    white-space:nowrap;
  }
  .cart_top .continue-shopping svg{width:15px;height:15px;flex-shrink:0;}
  .cart_top .cart-heading{
    color:var(--cart-green);
    font-weight:800;
    font-size:19px;
    margin:0;
    text-align:center;
    flex:1;
  }
  .cart_top .cart-count-badge{
    width:30px;height:30px;flex-shrink:0;
    border-radius:50%;
    background:var(--cart-gold);
    color:#fff;
    display:flex;align-items:center;justify-content:center;
    font-size:13px;font-weight:700;
  }

  /* ---------------- Body ---------------- */
  .cart_media{
    flex:1;
    overflow-y:auto;
    padding:16px 14px;
  }

  /* free shipping bar */
  .freeShipping{
    background:#fff;
    border:1px solid var(--cart-line);
    border-radius:12px;
    padding:12px;
    margin:0 0 14px;
    font-size:12.5px;
  }
  .freeShipping p{margin-bottom:8px;color:#5b6b5f;}
  .freeShipping .progress{
    height:7px;border-radius:10px;
    background-color:#eee4cf !important;overflow:hidden;
  }
  .freeShipping .progress-bar{
    background-color:var(--cart-gold) !important;
    font-size:0;line-height:7px;
  }

  /* cart item card */
  .cartListMedia{list-style:none;padding:0;margin:0;}
  .cartListMedia li{
    background:#fff;
    border:1px solid var(--cart-line);
    border-radius:16px;
    padding:14px;
    margin-bottom:12px;
    display:flex;
    gap:12px;
    align-items:flex-start;
    box-shadow:0 2px 8px rgba(0,0,0,.03);
  }
  .cartListMedia li > img{
    width:54px;height:64px;
    object-fit:contain;
    border-radius:8px;
    background:#f7f4ec;
    flex-shrink:0;
  }
  .cartListMedia .item{flex:1;min-width:0;}
  .cartListMedia .row-top{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:8px;
  }
  .cartListMedia .title{
    display:block;
    font-weight:700;
    font-size:13.5px;
    color:var(--cart-green-2);
    line-height:1.35;
    margin:0 0 10px;
  }
  .cartListMedia .remove{
    color:#b6bcae;
    cursor:pointer;
    flex-shrink:0;
    line-height:1;
    transition:color .15s;
  }
  .cartListMedia .remove:hover{color:#d9534f;}

  .cartListMedia .row-bottom{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:8px;
    margin-top:2px;
  }
  .cartInput{
    display:inline-flex;
    align-items:center;
    border:1px solid var(--cart-line);
    border-radius:10px;
    overflow:hidden;
    background:#fff;
  }
  .cartInput .cartUpdate{
    width:30px;height:30px;
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;
    font-weight:700;
    font-size:15px;
    color:var(--cart-gold);
    user-select:none;
    transition:background .15s;
  }
  .cartInput .cartUpdate:hover{background:#faf4e6;}
  .cartInput input.quantity{
    width:34px;height:30px;
    border:none;text-align:center;
    font-weight:700;font-size:13.5px;
    color:var(--cart-green-2);
    background:transparent;
  }
  .cartInput input.quantity::-webkit-outer-spin-button,
  .cartInput input.quantity::-webkit-inner-spin-button{-webkit-appearance:none;margin:0;}
  .cartListMedia .price{
    font-weight:800;
    font-size:14.5px;
    color:var(--cart-green-2);
    white-space:nowrap;
  }

  /* empty */
  .cart-empty{text-align:center;padding:48px 16px;color:#7c8a7f;}
  .cart-empty h2{font-size:18px;color:var(--cart-green);margin:0;}

  /* ---------------- You'll also love ---------------- */
  .cartLatestWrap{
    background:var(--cart-tint);
    border-radius:16px;
    padding:16px 14px;
    margin:4px 0 6px;
  }
  .cartLatestWrap .clHead{
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    margin-bottom:14px;
  }
  .cartLatestWrap .clHead h5{
    margin:0;
    font-size:16px;
    font-weight:800;
    color:var(--cart-green);
    position:relative;
    padding-bottom:8px;
  }
  .cartLatestWrap .clHead h5::after{
    content:"";
    position:absolute;left:0;bottom:0;
    width:34px;height:3px;border-radius:3px;
    background:var(--cart-gold);
  }
  .cartLatestWrap .clNav{display:flex;gap:6px;}
  .cartLatestWrap .clNav button{
    width:30px;height:30px;line-height:26px;
    border-radius:9px;
    border:1px solid #cdd8c6;
    background:#fff;
    color:var(--cart-green);
    font-size:16px;
    cursor:pointer;padding:0;
    transition:all .15s;
  }
  .cartLatestWrap .clNav button:hover{
    background:var(--cart-green);color:#fff;border-color:var(--cart-green);
  }

  .cartLatestSlider{margin:0;}
  .cartLatestSlider .slick-track{display:flex;align-items:stretch;}
  .cartLatestSlider .slick-slide{height:auto;}
  .cartLatestSlider .slick-slide > div{height:100%;padding:0 5px; margin-right: 5px}

  .cartLatestSlider .clItem{
    display:flex;
    flex-direction:column;
    height:100%;
    border:1px solid #e5e2d8;
    border-radius:14px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 2px 8px rgba(0,0,0,.04);
  }
  .cartLatestSlider .clThumb{
    display:block;width:100%;height:150px;
    background:#fff;padding:12px;
  }
  .cartLatestSlider .clThumb img{width:100%;height:100%;object-fit:contain;}
  .cartLatestSlider .clBody{
    flex:1;display:flex;flex-direction:column;
    background:#f6f2ea;
    padding:10px 11px 12px;
  }
  .cartLatestSlider .clTitle{
    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
    font-size:12px;font-weight:600;color:#3a463d;
    line-height:1.35;margin-bottom:7px;text-decoration:none;
  }
  .cartLatestSlider .clPrice{
    font-size:13.5px;font-weight:800;color:var(--cart-green-2);margin:0 0 9px;
  }
  .cartLatestSlider .clPrice del{color:#a7aaac;font-weight:500;font-size:11px;margin-left:5px;}
  .cartLatestSlider .clAdd{
    display:block;width:100%;margin-top:auto;
    text-align:center;font-size:12.5px;font-weight:700;
    padding:9px 10px;border-radius:8px;
    background:#112a1d;color:#fff;text-decoration:none;
    position:relative;transition:background .15s;
  }
  .cartLatestSlider .clAdd:hover{background:#0c703e;}

  /* ---------------- Footer ---------------- */
  .cartFooter{
    background:var(--cart-cream);
    padding:16px 18px;
    border-top:1px solid var(--cart-line);
  }
  .cartFooter .cttoal{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:12px;
  }
  .cartFooter .cttoal h5{color:var(--cart-green-2);font-size:16px;font-weight:700;margin:0;}
  .cartFooter .cttoal h4{color:var(--cart-green-2);font-size:19px;font-weight:800;margin:0;}
  .cartFooter .btn.orderModal,
  .cartFooter .orderModal{
    display:block;width:100%;
    background:#32133b;
    color:#fff;
    border:none;
    border-radius:10px;
    padding:13px 16px;
    font-size:15px;
    font-weight:700;
    box-shadow:0 4px 12px rgba(201,147,45,.28);
    animation:none;
    -webkit-animation:none;
    margin:0;
    transition:background .15s;
  }
  .cartFooter .orderModal:hover{background:var(--cart-gold-d);color:#fff;}

  @media only screen and (max-width:767px){
    .cart_top .cart-heading{font-size:17px;}
    .cart_top .continue-shopping{font-size:12px;}
    .cartFooter{position:static;width:auto;bottom:auto;}
  }
</style>

<div class="cart-inner">

    <!-- ===================== Header ===================== -->
    <div class="cart_top">
        <a href="javascript:void(0)" class="continue-shopping side-modals-close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Continue Shopping
        </a>
        <h4 class="cart-heading">Your Cart</h4>
        <span class="cart-count-badge">{{ isset($carts) ? $carts->sum('quantity') : 0 }}</span>
    </div>

    <!-- ===================== Body ===================== -->
    <div class="cart_media">

        @isset($carts)
        @if($carts->count() > 0)

            @if(general()->minimum_shopping > 0)
                <div class="freeShipping">
                    <p>
                        @if($cartTotalPrice >= general()->minimum_shopping)
                        <b>Congratulations!</b> You got free shipping
                        @else
                        You're <b>{{priceFullFormat(general()->minimum_shopping - $cartTotalPrice)}}</b> away from free shipping (In Dhaka City)
                        @endif
                    </p>
                    @php
                        $perchant = round(($cartTotalPrice / general()->minimum_shopping) * 100);
                        if($perchant > 100){ $perchant = 100; }
                    @endphp
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{$perchant}}%;" aria-valuenow="{{$perchant}}" aria-valuemin="0" aria-valuemax="100">{{$perchant}}%</div>
                    </div>
                </div>
            @endif

            <script>
                function viewCartDataCall(){
                    window.dataLayer = window.dataLayer || [];
                    dataLayer.push({
                        event: "view_cart",
                        ecommerce: {
                            currency: "{{ general()->currency }}",
                            value: {{ round($cartTotalPrice)}},
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
                }
            </script>

            <ul class="cartListMedia">
                @foreach($carts as $cart)
                <li>
                    @if($product=$cart->product)
                    <img src="{{asset($product->image())}}" alt="{{$product->name}}">
                    @endif
                    <div class="item">
                        <div class="row-top">
                            @if($product=$cart->product)
                            <span class="title">{{$product->name}}</span>
                            @endif
                            <span class="remove cartUpdate" data-url="{{ route('changeToCart', [$cart, 'delete']) }}" title="Remove">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </span>
                        </div>
                        <div class="row-bottom">
                            <div class="cartInput">
                                <span class="cartUpdate" data-url="{{ route('changeToCart', [$cart, 'decrement']) }}">&minus;</span>
                                <input type="number" readonly="" class="quantity" value="{{$cart->quantity}}">
                                <span class="cartUpdate" data-url="{{ route('changeToCart', [$cart, 'increment']) }}">+</span>
                            </div>
                            <span class="price">{{priceFullFormat($cart->itemprice() * $cart->quantity)}}</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>

        @else
            <div class="cart-empty">
                <h2>Your cart is empty</h2>
            </div>
        @endif
        @endisset

        {{-- ---------- You'll also love (auto slider) ---------- --}}
        @php
            $cartLatestProducts = \App\Models\Post::where('type', 2)
                ->where('status', 'active')
                ->latest()
                ->take(10)
                ->get();
        @endphp
        @if($cartLatestProducts->count() > 0)
        <div class="cartLatestWrap">
            <div class="clHead">
                <h5>You'll also love</h5>
                <div class="clNav">
                    <button type="button" class="clPrev" aria-label="Previous">&lsaquo;</button>
                    <button type="button" class="clNext" aria-label="Next">&rsaquo;</button>
                </div>
            </div>
            <div class="cartLatestSlider">
                @foreach($cartLatestProducts as $p)
                <div>
                    <div class="clItem">
                        <a href="{{ route('productView', $p->slug ?: Str::slug($p->name)) }}" class="clThumb">
                            <img src="{{ asset($p->image()) }}" alt="{{ $p->name }}" loading="lazy">
                        </a>
                        <div class="clBody">
                            <a href="{{ route('productView', $p->slug ?: Str::slug($p->name)) }}" class="clTitle">{{ Str::limit($p->name, 45) }}</a>
                            <div class="clPrice">
                                {{ priceFullFormat($p->offerPrice()) }}
                                @if($p->regular_price > $p->offerPrice())<del>{{ priceFullFormat($p->regular_price) }}</del>@endif
                            </div>
                            <a href="javascript:void(0)"
                               data-id="{{ $p->id }}"
                               data-url="{{ route('addToCart', $p->id) }}"
                               class="clAdd btn-cart">
                                <span class="load-more-overlay"></span> Buy now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <script>
            (function () {
                function initCartLatestSlider() {
                    if (!window.jQuery || typeof jQuery.fn.slick === 'undefined') { return; }
                    var $s = jQuery('.cartLatestSlider');
                    if (!$s.length) { return; }
                    $s.each(function () {
                        var $el = jQuery(this);
                        if ($el.hasClass('slick-initialized')) { $el.slick('unslick'); }
                        $el.slick({
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: true,
                            prevArrow: $el.closest('.cartLatestWrap').find('.clPrev'),
                            nextArrow: $el.closest('.cartLatestWrap').find('.clNext'),
                            dots: false,
                            autoplay: true,
                            autoplaySpeed: 3000,
                            pauseOnHover: true,
                            responsive: [
                                { breakpoint: 420, settings: { slidesToShow: 1 } }
                            ]
                        });
                    });
                }

                // run now (partial is injected via AJAX too, so this script re-runs)
                setTimeout(initCartLatestSlider, 60);

                // re-init when the cart drawer opens / cart changes (bind once)
                if (window.jQuery && !window.__cartLatestSliderBound) {
                    window.__cartLatestSliderBound = true;
                    jQuery(document).on('click', '.moble-menus-models, .moble-menus-models2, .btn-cart, .singleaddCart, .cartUpdate', function () {
                        setTimeout(initCartLatestSlider, 400);
                    });
                }
            })();
        </script>
        @endif
    </div>

    <!-- ===================== Footer ===================== -->
    <div class="cartFooter">
        @isset($carts)
        @if($carts->count() > 0)
        <div class="cttoal">
            <h5>Total</h5>
            <h4>{{priceFullFormat($cartTotalPrice)}}</h4>
        </div>
        <button class="btn orderModal orderModalAction" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            অর্ডার করুন
        </button>
        @endif
        @endisset
    </div>

</div>
