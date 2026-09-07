@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$product->seo_title?:websiteTitle($product->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$product->seo_title?:websiteTitle($product->name)}}" />
<meta name="description" property="og:description" content="{!!$product->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$product->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($product->image())}}" />
<meta name="url" property="og:url" content="{{route('productView',$product->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productView',$product->slug?:'no-title')}}" />
@endsection @push('css')

<style>

.orderNoteBox {
    border: 1px solid #ccc;
    padding: 20px;
    margin-top: 20px;
    background-color: #eee;
    text-align: center;
    border-radius: 5px;
}

.orderNoteBox p{
    margin: 0;
    padding: 0;
}

    .btn-wishlist.w-icon-heart.active {
        border-color: unset;
        color: #fff;
        background-color: unset;
    }
    .product-single .singleaddCart.disabled {
        background-color: #444;
        border-color: #444;
        color: #aaa;
        cursor: not-allowed;
    }
    .singleaddCart {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .ir {
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
    }

    /**
 * Gallery Styles
 * 1. Enable fluid images
 */
    .gallery {
        overflow: hidden;
    }

    img.zoomImg {
        width: 600px !important;
        height: 600px !important;
    }

    .gallery__hero {
        overflow: hidden;
        position: relative;
        margin: 0 0 0.3333333333em;
        background: #fff;
    }
    .is-zoomed .gallery__hero {
        cursor: move;
    }
    .is-zoomed .gallery__hero img {
        max-width: none;
        position: absolute;
        z-index: 0;
        top: -50%;
        left: -50%;
    }

    .gallery__hero-enlarge:hover {
        opacity: 1;
    }

    img.zoomImg:hover {
        cursor: crosshair;
    }

    .gallery__thumbs {
        text-align: center;
        background: #fff;
    }
    .gallery__thumbs a {
        display: inline-block;
        width: 20%;
        opacity: 0.75;
        transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);
    }
    .gallery__thumbs a:hover {
        opacity: 1;
    }
    .gallery__thumbs a.is-active {
        opacity: 1;
    }
    
    ol{
        padding-left: 0!important;
    }
    
    .ctgTag span {
        margin-bottom: 10px;
        color: #373535;
        display: block;
        text-transform: none;
        font-size: 16px;
    }
    
    .ctgTag span b {}
    
    .ctgTag span a {
        color: #6f6b6b;
    }
    
    .ctgTag span a:hover {
        color: black;
    }
    
    .ctgTag span a.share {
        margin-right: 5px;
        padding: 2px 5px;
        height: 30px;
        width: 30px;
        display: inline-block;
        border: 1px solid gray;
        text-align: center;
        border-radius: 100%;
    }
    
    .toggleText {
        border-bottom: 1px solid gray;
        margin-bottom: 15px;
    }
    
    .toggleText p {
        margin-bottom: 15px;
    }
    
    .toggleText ul {
        padding-left: 15px;
        margin-bottom: 15px;
    }
    
    .toggleText ul li {
        padding: 5px 0;
    }
    
    @media only screen and (max-width: 767px){
    
        img.zoomImg {
            width: 100% !important;
            height: 100% !important;
        }
    }
    
    
    
/* ==========================================
   PRODUCT VARIANT SELECTION (বাছাই করুন)
   ========================================== */

.product-variants-wrapper {
    margin-top: 15px;
    margin-bottom: 20px;
}

.variant-title {
    font-size: 16px;
    font-weight: 700;
    color: #333333;
    margin-bottom: 10px;
}

.variant-options-list {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

/* Individual Variant Button Style */
.variant-btn-item {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 24px;
    font-size: 16px;
    font-weight: 600;
    color: #333333;
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    text-decoration: none;
}

/* Hover State */
.variant-btn-item:hover {
    border-color: #84cc16;
    color: #15803d;
}

/* Selected/Active State (e.g. "১ কেজি" active style) */
.variant-btn-item.active {
    border: 2px solid #84cc16;
    color: #111827;
    background-color: #ffffff;
    font-weight: 700;
    box-shadow: 0 2px 4px rgba(132, 204, 22, 0.15);
}

/* ==========================================
   BUTTON LAYOUT & STYLING
   ========================================== */

.productDetailButton .row {
    row-gap: 12px;
}

.btnAddToCart {
    width: 100%;
    height: 48px;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* "কার্টে যোগ করুন" Button */
.btnAddToCart.addTo {
    background-color: #ffffff;
    color: #000000;
    border: 1.5px solid #000000;
}

.btnAddToCart.addTo:hover {
    background-color: #f8fafc;
}

/* "অর্ডার করুন" Button */
.btnAddToCart:not(.addTo) {
    background-color: #672678;
    color: #ffffff;
    border: none;
    border-radius: 0;
}

.btnAddToCart:not(.addTo):hover {
    background-color: #b91c1c;
}

/* WhatsApp & Call Buttons */
.order-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    height: 48px;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.2s ease;
}

.whatsapp-btn {
    background-color: #25d366;
    color: #ffffff;
        color: #ffffff;
    font-size: 22px;
    font-weight: bold;
}
.whatsapp-btn span {
    color: #fff;
    font-size: 15px;
}
.call-btn {
    background-color: #ffffff;
    color: #000000;
    border: 1.5px solid #000000;
}

.order-btn:hover {
    opacity: 0.9;
}
    
    .singlePagePart {
    padding: 40px 0;
    background: #eee;
}
    
  .singleProductContainer{
       background: #fff;
    padding: 50px;
    border-radius: 20px;
  }     
  
  
  /* ==========================================
   QUANTITY BOX DESIGN
   ========================================== */

/* কোয়ান্টিটি কনটেইনার */
.quntity {
    display: inline-flex !important;
    align-items: center;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    background-color: #ffffff;
    overflow: hidden;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    margin-bottom: 15px;
}

/* প্লাস (+) এবং মাইনাস (-) বাটন design */
.quntity .dcrementBtn,
.quntity .incrementBtn {
    width: 38px;
    height: 38px;
    background-color: #f9fafb;
    border: none;
    color: #374151;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    user-select: none;
}

/* বাটন হোভার ইফেক্ট */
.quntity .dcrementBtn:hover,
.quntity .incrementBtn:hover {
    background-color: #e5e7eb;
    color: #111827;
}

/* ইনপুট ফিল্ড design (যেখানে সংখা দেখাবে) */
.quntity input#quantity {
    width: 45px;
    height: 38px;
    border: none;
    border-left: 1px solid #e5e7eb;
    border-right: 1px solid #e5e7eb;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    background-color: #ffffff;
    outline: none;
    pointer-events: none; /* ইনপুটে সরাসরি লিখা বন্ধ রাখবে */
}
  
  
  
  
  
  
  .singleProductDescriptionPart .tab-content {
    padding: unset;
    border: unset;
}
  .relatedProductPart {
    background: #f6f6f6;
    padding-top: 50px;
}
  
  
  .singleProductDescriptionPart {
    padding-top: 40px;
}
    
    .singlePrductInfoGrid h2 {
    color: #010c10;
    font-weight: 500;
    font-size: 22px;
}
    .SingleProcutprice span {
    color: #01080b;
}
    .SingleProcutprice span del {
    color: #dc2626;
    }
    
    
    
    .call-btn span {
    color: #000;
    font-size: 18px;
    font-weight: 500;
}
    
    
    
    .solinkandctg {
    margin-top: 20px;
}
    .productInfo h4 {
    text-align: left;
    font-size: 30px;
    color: #010c11;
    font-weight: 500;
    padding-bottom: 20px;
    text-transform: uppercase;
    margin-top: 0;
}
    
    .relatedProductPart h4 {
    text-align: left;
    font-size: 30px;
    color: #010c11;
    font-weight: 500;
    padding-bottom: 20px;
    text-transform: uppercase;
}

.orderModal {
    margin-top: 0;
}








/* ==========================================
   PRODUCT GALLERY UI
   ========================================== */

/* গ্যালারি মেইন কনটেইনার (Flex Layout) */
#js-gallery.gallery {
    display: flex !important;
    flex-direction: row-reverse; /* থাম্বনেইল বামে এবং বড় ইমেজ ডানে দেখানোর জন্য */
    gap: 15px;
    align-items: flex-start;
}

/* বড় ইমেজের বক্স (Hero Image) */
.gallery__zoomimg {
    flex: 1;
    border:1px solid #672678; /* ছবির বর্ডার কালার */
    border-radius: 12px;
    padding: 10px;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 380px;
    overflow: hidden;
}

.gallery__zoomimg img {
    width: 100%;
    height: auto;
    max-height: 480px;
    object-fit: contain;
    border-radius: 8px;
    transition: all 0.3s ease;
}

/* বামপাশের থাম্বনেইল লিস্ট */
.gallery__thumbs {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 85px;
    flex-shrink: 0;
}

/* থাম্বনেইল বাটন স্টাইল */
.gallery__thumbs a {
    display: block;
    border: 1.5px solid #e5e7eb;
    border-radius: 8px;
    padding: 3px;
    background-color: #ffffff;
    cursor: pointer;
    transition: all 0.2s ease;
    overflow: hidden;
}

.gallery__thumbs a img {
    width: 100%;
    height: 75px;
    object-fit: cover;
    border-radius: 5px;
    display: block;
}

/* সক্রিয় (Active) এবং হোভার অবস্থা */
.gallery__thumbs a.is-active,
.gallery__thumbs a:hover {
    border-color: #84cc16;
    box-shadow: 0 0 0 1px #84cc16;
}

/* রেসপন্সিভ (মোবাইল ডিভাইসের জন্য) */
@media (max-width: 576px) {
    #js-gallery.gallery {
        flex-direction: row-reverse; /* মোবাইলে নিচে থাম্বনেইল দেখাবে */
    }
    .gallery__thumbs {
        flex-direction: row;
        width: 100%;
        overflow-x: auto;
    }

    .singleProductContainer {
         padding: 0px;
    }
    
    .gallery__thumbs a {
        width: 75px;
        height: 85px;
    }
    

    
    
}














/* ==========================================
   FIXED GALLERY THUMBS VISUAL ISSUE
   ========================================== */

/* থাম্বনেইল কন্টেইনার */
.gallery__thumbs {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 80px; /* থাম্বনেইল এরিয়ার নির্দিষ্ট প্রস্থ */
    flex-shrink: 0;
}

/* থাম্বনেইল বাটন লিঙ্ক */
.gallery__thumbs a {
    display: block;
    width: 85px;         /* নির্দিষ্ট উইডথ */
    height: 100px;        /* নির্দিষ্ট হাইট (Square Shape) */
    border: 1.5px solid #e5e7eb;
    border-radius: 8px;
    padding: 3px;
    background-color: #ffffff;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    box-sizing: border-box;
}

/* থাম্বনেইল ইমেজ স্টাইল (ছবি চ্যাপ্টা না হওয়ার জন্য) */
.gallery__thumbs a img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important; /* ইমেজ যাতে রেশিও ঠিক রেখে ক্রপ হয়ে ফিট হয় */
    border-radius: 5px;
    display: block;
}

/* এক্টিভ ও হোভার বর্ডার */
.gallery__thumbs a.is-active, .gallery__thumbs a:hover {
    border-color: #672678;
}

.dcrementBtn {
    border-right: unset !important;
}

.incrementBtn {
    border-left: unset !important;
}

.btnAddToCart:not(.addTo) svg {
    margin-right: 20px;
}


/* রেসপন্সিভ (মোবাইল ডিভাইসের জন্য) */
@media (max-width: 576px) {

    .gallery__thumbs a {
        width: 75px;
        height: 65px;
    }
    
    .gallery__zoomimg {
        min-height: 100%;
    }
    
    .singlePagePart {
        padding: 15px 0;
        background: #ffffff;
    }
    
    .productDetailButton button {
        font-size: 13px;
    }
    .whatsapp-btn span {
        font-size: 11px;
    }
    .whatsapp-btn {
        font-size: 14px;
    }
    .call-btn span {
        font-size: 11px;
    }
    .singleProductDescriptionPart {
        padding-top: 0px;
    }
    .productInfo h4 {
         font-size: 20px;
    }
    .relatedProductPart h4 {
        font-size: 20px;
    }
    
}

    
    
</style>


<script>

    window.dataLayer = window.dataLayer || [];

    dataLayer.push({
        event: "page_view",
        page_category: "Product Details",
        page_title: "{{$product->name}}",
        page_url: "{{route('productView',$product->slug?:'no-title')}}"
    });
    
    
    dataLayer.push({
        event: "view_item",
        ecommerce: {
            items: [{
                item_id: "{{ $product->id }}",
                item_name: "{{ $product->name }}",
                currency: "{{ general()->currency }}", // Your currency
                item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}", // Concatenate categories
                item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                price: "{{ $product->offerPrice() }}",
                item_variant: "{{ $product->variant ?? '' }}",
            }]
        }
    });
    
    
    function addToCart(product) {
        window.dataLayer = window.dataLayer || [];
        
        var qty = $('#quantity').val() || 0;
        
        dataLayer.push({
            event: "add_to_cart",
            ecommerce: {
                items: [{
                    item_id: product.id,
                    item_name: product.name,
                    item_category: product.category_name,
                    price: product.final_price,
                    quantity: parseInt(qty, 10)
                }]
            }
        });
    }
    
    
</script>

@endpush @section('contents')

<!-- Start of Page Header -->
{{--<div class="page-header" style="background-image: url({{asset($product->image())}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">{{$product->name}}</h1>
        </div>
    </div>
</div>--}}
<!-- End of Page Header -->

<div class="singlePagePart">
    <div class="container">
        <div class="singleProductContainer">
        <div class="row">
            <div class="col-md-6">
                <div class="singleProductLeftGrid">
                    <!-- Gallery -->
                    <div id="js-gallery" class="gallery">
                        <!--Gallery Hero-->
                        <div class="gallery__zoomimg">
                            <img src="{{asset($product->image())}}" alt="{{$product->name}}" />
                        </div>
                        <!--Gallery Hero-->

                        <!--Gallery Thumbs-->
                        <div class="gallery__thumbs">
                            @foreach($product->galleryFiles as $file)
                            <a href="{{asset($file->image())}}" data-gallery="thumb" class="is-active">
                                <img src="{{asset($file->image())}}" />
                            </a>
                            @endforeach
                        </div>
                        <!--Gallery Thumbs-->
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="singlePrductInfoGrid">
                    <h2>{{$product->name}}</h2>
                    @if($product->weight_per_pices)
                    <span style="font-weight: bold;color: black;">{!!$product->weight_per_pices!!}</span>
                    @endif
                    <p class="SingleProcutprice">
                        <span> {{priceFullFormat($product->offerPrice())}} /  @if($product->regular_price > $product->offerPrice()) <del>{{priceFullFormat($product->regular_price)}}</del> @endif</span> 
                        <!--@if($product->regular_price > $product->offerPrice())-->
                        <!--<span class="saveTk">Save {{priceFormat($product->regular_price - $product->offerPrice())}} BDT</span>-->
                        <!--@endif-->
                    </p>
                    
                    <h6 class="stockReady">Availability: <span class="stock">In Stock</span></h6>

                    @include(welcomeTheme().'.alerts')
                    <form action="{{route('addToCart',$product->id)}}" class="singleForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="quntity" style="margin-bottom: 0;">
                                    <!--<span>Quantity</span>-->
                                    <button class="dcrementBtn" id="decrement">-</button>
                                    <input id="quantity" readonly="" name="quantity" type="text" value="1" step="any" />
                                    <button class="incrementBtn" id="increment">+</button>
                                </div>
                                <!--<p>-->
                                <!--    <b>Gross Weight:</b> <span class="grossWeight" data-weight="{{$product->weight_per_ices}}" >{{$product->productGrossWeightAmount()}}</span>-->
                                <!--    <b>Net Weight:</b> <span class="NetWeight" data-weight="{{$product->weight_amount?:1}}">{{$product->productWeightAmount()}}</span>-->
                                <!--</p>-->
                            </div>
                            
                            <div class="productDetailButton mt-4">
                                <div class="row">
                                
                          
                            <div class="col-md-6 col-6">
                                <button type="button" name="orderNow" value="cart" onclick="addToCart({{ json_encode($product) }})" data-url="{{route('addToCart',$product->id)}}" class="btnAddToCart singleaddCart addTo">কার্টে যোগ করুন</button>
                            </div>
                            <div class="col-md-6 col-6">
                                
                                  <button type="button" name="orderNow" value="checkout"
                                    onclick="addToCart({{ json_encode($product) }})"
                                    data-url="{{route('addToCart',$product->id)}}"
                                    class="btnAddToCart singleaddCart btn orderModal goCheckout">
                                    অর্ডার করুন
                                </button>
                                <button type="button" id="exampleModalTrigger" style="display:none" data-bs-toggle="modal" data-bs-target="#exampleModal" aria-hidden="true"></button>
                               
                                
                                <!--<button type="button" name="orderNow" value="checkout" onclick="addToCart({{ json_encode($product) }})" data-url="{{route('addToCart',$product->id)}}" class="btnAddToCart singleaddCart btn orderModal orderModalAction"><svg xmlns="http://www.w3.org/2000/svg" width="23px" viewBox="0 0 24 24" class="_rsi-button-icon _rsi-button-icon-left" fill="rgba(255,255,255,1)"><path d="M0 0h24v24H0V0z" fill="none"></path><g><rect fill="none" height="24" width="24"></rect><path d="M18,6h-2c0-2.21-1.79-4-4-4S8,3.79,8,6H6C4.9,6,4,6.9,4,8v12c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8C20,6.9,19.1,6,18,6z M12,4c1.1,0,2,0.9,2,2h-4C10,4.9,10.9,4,12,4z M18,20H6V8h2v2c0,0.55,0.45,1,1,1s1-0.45,1-1V8h4v2c0,0.55,0.45,1,1,1s1-0.45,1-1V8 h2V20z"></path></g></svg>অর্ডার করুন</button>-->
                            </div>
                            
                             <!-- WhatsApp Order -->
                                <div class="col-lg-6 col-md-6 col-6">
                                    <a href="https://wa.me/8801313610173?text={{ urlencode('আমি এই পণ্যটি অর্ডার করতে চাই: '.$product->name.' - '.url(route('productView', $product->slug ?: Str::slug($product->name)))) }}"
                                       target="_blank" rel="noopener"
                                       class="order-btn whatsapp-btn">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        <span>হোয়াটসঅ্যাপে অর্ডার: <strong>01313610173</strong></span>
                                    </a>
                                </div>
                    
                                <!-- Call Order -->
                                <div class="col-lg-6 col-md-6 col-6">
                                    <a href="tel:09678812525" class="order-btn call-btn">
                                        <span>কল অর্ডার: <strong>09678812525</strong></span>
                                    </a>
                                </div>
                            
                              </div>
                            </div>
                        </div>
                    </form>

                    
                    <div class="solinkandctg">
                        <p class="ctgTag">
                            
                            @if($product->productCategories->count()  > 0)
                            <span>
                            <b>ক্যাটাগরি:</b> @foreach($product->productCategories as $i=>$ctg){{$i==0?'':','}} <a href="{{route('productCategory',$ctg->slug?:'no-title')}}">{{$ctg->name}} </a> @endforeach
                            </span>
                            @endif
                            @if($product->productTags->count() > 0)
                            <span>
                            <b>Tag: </b> @foreach($product->productTags as $i=>$ptag) @if($tag =$ptag->attribute) {{$i==0?'':','}} {{$tag->name}} @endif @endforeach
                            </span>
                            @endif
                       <span class="share-section" style="display: inline-flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <b style="font-size: 15px; color: #333;">Share: </b> 
                        
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url(route('productView', $product->slug ?: 'no-title')) }}" target="_blank" class="share-icon" style="background-color: #1877F2; color: #fff; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; transition: opacity 0.2s;">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    
                        <a href="https://www.instagram.com/" target="_blank" class="share-icon" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: #fff; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; transition: opacity 0.2s;">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    
                        <a href="https://pinterest.com/pin/create/button/?url={{ url(route('productView', $product->slug ?: 'no-title')) }}&media={{asset($product->image())}}&description={{ urlencode($product->name) }}" target="_blank" class="share-icon" style="background-color: #BD081C; color: #fff; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; transition: opacity 0.2s;">
                            <i class="fa-brands fa-pinterest-p"></i>
                        </a>
                    
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url(route('productView', $product->slug ?: 'no-title')) }}&title={{ urlencode($product->name) }}" target="_blank" class="share-icon" style="background-color: #0A66C2; color: #fff; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; transition: opacity 0.2s;">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    
                        <a href="https://wa.me/?text={{ urlencode($product->name . ' : ' . url(route('productView', $product->slug ?: 'no-title'))) }}" target="_blank" class="share-icon" style="background-color: #25D366; color: #fff; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 14px; transition: opacity 0.2s;">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </span>
                        </p>
                    </div>
                    <!--<div class="orderNoteBox">-->
                    <!--    <p>-->
                    <!--        Order within the next <b id="countdown"></b> for dispatch today, and you'll receive your package between <span id="dates"></span>-->
                    <!--    </p>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="singleProductDescriptionPart">
    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <!--<li class="nav-item" role="presentation">-->
            <!--    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">-->
            <!--        Description-->
            <!--    </button>-->
            <!--</li>-->
            <!--<li class="nav-item" role="presentation">-->
            <!--    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">-->
            <!--        Additional Information-->
            <!--    </button>-->
            <!--</li>-->
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                 
                    <div class="col-md-12">
                        <div class="productInfo">
                            <h4>Product information</h4>
                            <p>
                                {!!$product->description!!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="addtionalInfo">
                    <p>
                        
                    </p>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- related product start -->
<div class="relatedProductPart">
    <div class="container">
        <h4>Related Products</h4>

        <div class="row">
            @foreach($relatedProducts as $product)
            <div class="col-md-3 col-6" style="padding: 0 10px;">
                @include(welcomeTheme().'products.includes.productCard')
            </div>
            @endforeach
        </div>
        
    </div>
</div>
<!-- related product end -->





















@endsection @push('js')

<script>
    $(document).ready(function() {
        function formatDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1; // Months are zero-based
            var year = date.getFullYear();
            
            // Add leading zero for single digit months and days
            if (day < 10) day = '0' + day;
            if (month < 10) month = '0' + month;
            
            return day + '/' + month + '/' + year;
        }

        function displayFutureDates() {
            var today = new Date();
            const currentHour = today.getHours();
            // Calculate dates 4 and 5 days from today
            if (currentHour < 12) {
                var date4DaysFromNow = new Date(today);
                date4DaysFromNow.setDate(today.getDate() + 1);
        
                var date5DaysFromNow = new Date(today);
                date5DaysFromNow.setDate(today.getDate() + 2);
            } else {
                var date4DaysFromNow = new Date(today);
                date4DaysFromNow.setDate(today.getDate() + 2);
        
                var date5DaysFromNow = new Date(today);
                date5DaysFromNow.setDate(today.getDate() + 3);
            }
        
            // Format dates
            var formattedDate4DaysFromNow = formatDate(date4DaysFromNow);
            var formattedDate5DaysFromNow = formatDate(date5DaysFromNow);
        
            // Display dates
            $("#dates").html("<b>" + formattedDate4DaysFromNow + "</b> & " + "<b>" + formattedDate5DaysFromNow + "</b>");
        }
        
        displayFutureDates();
    });
</script>

<script>
    $(document).ready(function() {
        function updateCountdown() {
            var now = new Date();
            var targetTime = new Date();
            
            // Set target time to 12 PM of the current day
            targetTime.setHours(12, 0, 0, 0);

            // If it's already past 12 PM, set target time to 12 PM of the next day
            if (now.getTime() > targetTime.getTime()) {
                targetTime.setDate(targetTime.getDate() + 1);
            }

            var timeDifference = targetTime - now;
            var hours = Math.floor(timeDifference / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

            $('#countdown').text(hours + ' hours ' + minutes + ' minutes');
        }

        // Update the countdown every minute
        updateCountdown();
        setInterval(updateCountdown, 60000);
    });
</script>

<script>

if ($(window).width() > 768) {
    
    var App = (function () {

      //=== Use Strict ===//
      'use strict';

      //=== Private Variables ===//
      var gallery = $('#js-gallery');
      $('.gallery__zoomimg').zoom();


      //=== Gallery Object ===//
      var Gallery = {
        zoom: function(imgContainer, img) {
          var containerHeight = imgContainer.outerHeight(),
          src = img.attr('src');

        },
        switch: function(trigger, imgContainer) {
          var src = trigger.attr('href'),
          thumbs = trigger.siblings(),
    			img = trigger.parent().prev().children();

          // Add active class to thumb
          trigger.addClass('is-active');

          // Remove active class from thumbs
          thumbs.each(function() {
            if( $(this).hasClass('is-active') ) {
              $(this).removeClass('is-active');
            }
          });


          // Switch image source
          img.attr('src', src);
        }
      };

      //=== Public Methods ===//
      function init() {


       // Listen for clicks on anchors within gallery
        gallery.delegate('a', 'click', function(event) {
          var trigger = $(this);
          var triggerData = trigger.data("gallery");

          if ( triggerData === 'zoom') {
            var imgContainer = trigger.parent(),
            img = trigger.siblings();
            Gallery.zoom(imgContainer, img);
          } else if ( triggerData === 'thumb') {
            var imgContainer = trigger.parent().siblings();
            Gallery.switch(trigger, imgContainer);
          } else {
            return;
          }

          event.preventDefault();
        });
      }

      //=== Make Methods Public ===//
      return {
        init: init
      };

    })();

    App.init();
}else{
    
    $('.gallery__thumbs a').click(function(e){
        e.preventDefault();
        $('.gallery__thumbs a').removeClass('is-active');
        $(this).addClass('is-active');
        
        img = $(this).attr('href');
        $('.gallery__zoomimg img').attr('src',img);
        
    });
    
}
    $(document).ready(function(){

        $(document).on("click", ".product-variations .size", function (e) {
            $('.product-variations .size').removeClass('active');
            $(this).addClass('active');
            var size=null;
            if($('.product-variations .size.active').data('id')){
               size =$('.product-variations .size.active').data('id');
            }
            $('.product-size-swatch .input').val(size);
            activeCartBtn();
        });

        $(document).on("click", ".product-variations .color", function (e) {
            $('.product-variations .color').removeClass('active');
            $(this).addClass('active');
            var color=null;
            if($('.product-variations .color.active').data('id')){
               color =$('.product-variations .color.active').data('id');
            }
            $('.product-color-swatch .input').val(color);
            activeCartBtn();
        });

        function activeCartBtn(){
            var allSizesActive =false;
            var allColorsActive =false;
            var status=true;
            if($('.product-variation-form').hasClass('product-size-swatch')){
                allSizesActive =allHaveClass('.product-variations .size', 'active');
            }
            if($('.product-variation-form').hasClass('product-color-swatch')){
               allColorsActive =allHaveClass('.product-variations .color', 'active');
            }

            if(allSizesActive){
                status=false;
            }else if(allColorsActive){
                status=false;
            }

            if(status){
               $('.singleaddCart').removeClass('disabled');
            }

        }

        $(document).on("click", ".singleaddCart.disabled", function (e) {
            var allSizesActive =false;
            var allColorsActive =false;
            if($('.product-variation-form').hasClass('product-size-swatch')){
                allSizesActive =allHaveClass('.product-variations .size', 'active');
            }
            if($('.product-variation-form').hasClass('product-color-swatch')){
               allColorsActive =allHaveClass('.product-variations .color', 'active');
            }
            if(allSizesActive){
                alert('Please Select Size');
            }else if(allColorsActive){
                alert('Please Select Color');
            }
        });

        function allHaveClass(selector, className) {
            var allHaveClass = true;
            $(selector).each(function() {
                if ($(this).hasClass(className)) {
                    allHaveClass = false;
                }
            });
            return allHaveClass;
        }

        $(document).on("click", ".singleaddCart:not(.disabled)", function (e) {

            var that =$(this);
            var url = that.attr("data-url");

            var data = $('.singleForm').serialize();
            $('.alert-cart-product').remove();

            $.ajax({
                url: url,
                method: "POST",
                data: data,
                beforeSend: function() {
                    $(that).find('.load-more-overlay').removeClass('loading');
                },
            })
            .done(function (data) {
                $(that).find('.load-more-overlay').removeClass('loading');
                $(".cart-count").empty().append(data.cartCount);
                $(".cartAreaSection").empty().append(data.cartItem);
                $(".cartAreaSection2").empty().append(data.cartItem2);

                if (that.hasClass('goCheckout')) {
                    // Product added — now open a fresh checkout modal (the old
                    // one was just replaced by the .cartAreaSection2 refresh above)
                    if (typeof beginCheckout === 'function') { beginCheckout(); }
                    var trigger = document.getElementById('exampleModalTrigger');
                    if (trigger) { trigger.click(); }
                } else {
                    $('.mobile-menu-side-modals').addClass('open-side');
                    $("body").css('overflow-y','hidden');
                }
            })
            .fail(function () {
                $(that).removeClass('load-more-overlay loading');
                // location.reload(true);
            });

        });
    });
</script>

@endpush