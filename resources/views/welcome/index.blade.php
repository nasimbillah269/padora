@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle()}}</title>
@endsection 
@section('SEO')
<meta name="title" property="og:title" content="{{general()->meta_title}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->favicon())}}" />
<meta name="url" property="og:url" content="{{route('index')}}" />
<link rel="canonical" href="{{route('index')}}">
@endsection 
@push('css')
<script type="application/ld+json">
    { 
    "@context": "https://schema.org", 
    "@type": "WebPage", 
    "url": "{{route('index')}}", 
    "name": "{{websiteTitle()}}",
    "author": {
        "@type": "Webpage",
        "name": "{{websiteTitle()}}"
    },
    "description": "{!!general()->meta_description!!}"
    }
</script>


<script>
        
      
            window.dataLayer = window.dataLayer || [];
    
            dataLayer.push({
                event: "page_view",
                page_category: "Homepage",
                page_title: "{{websiteTitle()}}",
                page_url: "{{route('index')}}"
            });
    
            
            // dataLayer.push({
            //     event: "view_item_list",
            //     ecommerce: {
            //         items: [
            //             @foreach($mostSalesCollection as $index => $product)
            //             {
            //                 item_id: "{{ $product->id }}",
            //                 item_name: "{{ $product->name }}",
            //                 currency: "{{general()->currency}}",
            //                 item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}", // Concatenate categories
            //                 item_brand: "{{ $product->brand?$product->brand->name:'' }}",
            //                 price: "{{ $product->offerPrice() }}",
            //                 quantity: "{{ $product->quantity?:9999}}",
            //                 index: "{{ $index + 1 }}" // Index starts at 1
            //             }@if(!$loop->last),@endif
            //             @endforeach
            //         ]
            //     }
            // });


    
        function addToCart(product) {
            window.dataLayer = window.dataLayer || [];
            dataLayer.push({
                event: "add_to_cart",
                ecommerce: {
                    items: [{
                        item_id: product.id,
                        item_name: product.name,
                        item_category: product.category_name,
                        price: product.final_price,
                        quantity: 1
                    }]
                }
            });
        }
    
    
</script>

<style>
    
    .categoryTab .row{
        margin:0 -10px;
    }
    
    .categoryTab .row .col-md-3{
        padding: 10px;
    }
    @media only screen and (max-width: 767px){
       .categoryTab .row{
            margin:0 -5px;
        }
        
        .categoryTab .row .col-md-3{
            padding: 5px;
        } 
    }
</style>



@endpush 

@section('contents')

@include(welcomeTheme().'layouts.slider')


<div class="category-navbar">
        <div class="container-fluid d-flex justify-content-md-center align-items-center">
            @foreach($categoris as $ctg)
            <a href="{{route('productCategory',$ctg->slug?:Str::slug($ctg->name))}}" class="category-item">
                <div class="icon-circle">
                    <!--<i class="fa-solid fa-fire"></i>-->
                    <img src="{{asset($ctg->image())}}" alt="{{$ctg->name}}" />
                </div>
                <span class="category-label">{{$ctg->name}}</span>
            </a>
            @endforeach
       

           {{-- <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-vest"></i>
                </div>
                <span class="category-label">Saree</span>
            </a>

            <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-shirt"></i>
                </div>
                <span class="category-label">Kurtis</span>
            </a>

            <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-person-dress"></i>
                </div>
                <span class="category-label">Dresses</span>
            </a>

            <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-gem"></i>
                </div>
                <span class="category-label">Jewelry</span>
            </a>

            <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <span class="category-label">Bags</span>
            </a>

            <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-shoe-prints"></i>
                </div>
                <span class="category-label">Footwear</span>
            </a>

            <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-boxes-packing"></i>
                </div>
                <span class="category-label">Combo</span>
            </a>

            <a href="#" class="category-item">
                <div class="icon-circle">
                    <i class="fa-solid fa-crown"></i>
                </div>
                <span class="category-label">Premium</span>
            </a>--}}

        </div>
    </div>
    
    
<div class="homeProductLayout">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
            <h4 class="mb-0">OUR BEST SELLERS</h4>
            <div class="slider-arrows d-flex gap-2">
                <button type="button" class="btn btn-outline-dark rounded-circle custom-prev p-0 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-outline-dark rounded-circle custom-next p-0 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="best-sellers-slider">
            @foreach($mostSalesCollection as $product)
            <div class="px-2">
                @include(welcomeTheme().'.products.includes.productCard')
            </div>
            @endforeach
        </div>
    </div>
</div>



@php
    $categories = App\Models\Attribute::where('type', 0)->latest()->get();
@endphp

<div class="category-wise-products py-4">
    <div class="container">
        @foreach($categories as $category)
            @php
                $products = App\Models\Post::where('status', 'active')
                    ->whereHas('ctgProducts', function($q) use($category) {
                        $q->where('reff_id', $category->id);
                    })
                    ->latest()
                    ->take(10) // স্লাইডারের জন্য ১০টি প্রোডাক্ট আনা হচ্ছে
                    ->get();
            @endphp

            @if($products->count() > 0)
                <div class="category-block mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="category-title text-uppercase mb-0">{{ $category->name }}</h4>
                        
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{route('productCategory',$category->slug?:Str::slug($category->name))}}" class="btn btn-sm btn-outline-dark me-2">
                                View All
                            </a>
                            <button type="button" class="btn btn-outline-dark rounded-circle cat-prev-{{ $category->id }} p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn btn-outline-dark rounded-circle cat-next-{{ $category->id }} p-0 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="category-slider-{{ $category->id }}">
                        @foreach($products as $product)
                            <div class="px-2">
                                @include(welcomeTheme().'.products.includes.productCard')
                            </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    $(document).ready(function(){
                        $('.category-slider-{{ $category->id }}').slick({
                            dots: false,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            autoplay: true,
                            autoplaySpeed: 3000,
                            prevArrow: $('.cat-prev-{{ $category->id }}'),
                            nextArrow: $('.cat-next-{{ $category->id }}'),
                            responsive: [
                                {
                                    breakpoint: 1200,
                                    settings: { slidesToShow: 4 }
                                },
                                {
                                    breakpoint: 992,
                                    settings: { slidesToShow: 3 }
                                },
                                {
                                    breakpoint: 768,
                                    settings: { slidesToShow: 2 }
                                },
                                {
                                    breakpoint: 480,
                                    settings: { slidesToShow: 2 }
                                }
                            ]
                        });
                    });
                </script>
            @endif
        @endforeach
    </div>
</div>









<!-- product category section start -->
<div class="productCategoryPart" style="padding-top: 20px;">
    <div class="container">
        <!--<p>Our Products</p>-->
        <h4 style="padding-bottom:0;">All Products</h4>
        <div class="categoryTab">
            <div class="row mt-4 mb-5">
                @foreach($featuredCollection as $product)
                <div class="col-md-3 col-6">
                    @include(welcomeTheme().'.products.includes.productCard')
                </div>
                @endforeach
            </div>
            <a href="{{ route('pageView','all-products') }}" class="allProBtn">View All Products</a>
        </div>
    </div>
</div>
<!-- product category section end -->

<!-- product banner section start -->
{{--<div class="productBannerPart">
    <div class="container">
        <div class="row">
            @foreach($offerBanners as $i=>$offerBanner)
            @if($i==0)
            <div class="col-md-5">
                <div class="productBannerSmallGrid">
                    <div class="productBannerBgImg" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($i==1)
            <div class="col-md-7">
                <div class="productBannerLeargGrid">
                    <div class="productBannerBgImg bg2" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($i==2)
            <div class="col-md-7">
                <div class="productBannerLeargGrid">
                    <div class="productBannerBgImg bg3" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($i==3)
            <div class="col-md-5">
                <div class="productBannerSmallGrid">
                    <div class="productBannerBgImg" style="background-image: url({{asset($offerBanner->image())}});">
                        <div class="productBannerContent">
                            <h5>{{$offerBanner->name}}</h5>
                            <p>{{$offerBanner->content}}</p>
                            <a href="{{$offerBanner->banner_link}}">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>--}}
<!-- product banner section end -->

<!-- best seller product section start -->
{{--<div class="bestSellerProductPart">
    <div class="sectionBgImg" style="background-image: url({{asset('welcome/images/bg-bestseller.jpg')}});">
        <div class="overly">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bestSellerLeftGrid">
                            <!--<img src="{{asset('welcome/images/Untitled design.jpg')}}" alt="AJL Sea Food" />-->
                            <iframe width="100%" height="500" src="https://www.youtube.com/embed/f1GyVt07WDI?si=i6b4ALtH9K6-mUGv" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bestSellerRightGrid">
                            <p>Our Products</p>
                            <h5>Best Sale</h5>
                            <div class="row">
                                @foreach($mostSalesCollection as $saleProduct)
                                <div class="col-md-6">
                                    <div class="newProductRow">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="bestSellerGrid">
                                                    <img src="{{asset($saleProduct->image())}}" alt="{{$saleProduct->name}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="bestSellerGrid">
                                                    <h6><a href="{{route('productView',$saleProduct->slug?:Str::slug($saleProduct->name))}}">{{Str::limit($saleProduct->name,15)}}</a></h6>
                                                    <div class="rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <span>(5)</span>
                                                    </div>
                                                    <p class="price"><span>
                                                        @if($saleProduct->regular_price > $saleProduct->offerPrice())<del>{{priceFormat($saleProduct->regular_price)}}</del>@endif
                                                        {{priceFullFormat($saleProduct->offerPrice())}} / kg
                                                    </span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<!-- best seller product section end -->

<!-- buiness info section start -->
{{--<div class="buinessInfoPart">
    <div class="buinessInfoSectionBgImg" style="background-image: url({{asset('welcome/images/bg-service.jpg')}});">
        <div class="bgOverly">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="buinessInfoGrid">
                            <img src="{{asset('welcome/images/3280126.png')}}" alt="AJL Sea Food" />
                            <h5>Choose Items</h5>
                            <p>
                                Select from a wide range of fresh seafood, carefully sourced and ready to meet your culinary needs.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="buinessInfoGrid">
                            <img src="{{asset('welcome/images/icon-02-1.png')}}" alt="AJL Sea Food" />
                            <h5>Place Your Address</h5>
                            <p>
                                Provide your delivery details, and we’ll ensure your order reaches you fresh and on time.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="buinessInfoGrid">
                            <img src="{{asset('welcome/images/paymzent.png')}}" alt="AJL Sea Food" />
                            <h5>Payment & Delivery</h5>
                            <p>
                                Pay delivery charge to confirm & enjoy cash on delivery service right at your doorstep.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<!-- buiness info section end -->

<!-- letest blog section part start -->
{{--<div class="latestBlogPart">
    <div class="container">
        <span>Our Blogs</span>
        <h4>Latest Blogs</h4>
        <div class="row">
            @foreach($latestPosts as $post)
            <div class="col-md-4">
                @include(welcomeTheme().'blogs.includes.blogGrid')
            </div>
            @endforeach
        </div>
    </div>
</div>--}}
<!-- letest blog section part end -->

<!-- Popular Woman Fashion Brands Section -->
<div class="popular-brands-section py-5 bg-white">
    <div class="container">
        <!-- Section Title & Nav Arrows -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-uppercase">Popular Fashion Brands</h4>
                <p class="text-muted small mb-0">Explore top trending women's fashion labels</p>
            </div>
            <div class="brand-slider-arrows d-flex gap-2">
                <button type="button" class="btn btn-outline-dark rounded-circle brand-prev p-0 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button type="button" class="btn btn-outline-dark rounded-circle brand-next p-0 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Brand Slider (dynamic — from admin Suppliers / Clients) -->
        <div class="woman-fashion-brand-slider">
            @forelse($clients as $client)
                <div class="px-2">
                    <div class="brand-item-card card border shadow-sm text-center rounded-3 bg-white p-3">
                        <div class="brand-img-wrapper mb-2">
                            <img src="{{ asset($client->image()) }}" alt="{{ $client->name }}" class="img-fluid brand-thumb" loading="lazy">
                        </div>
                        <h6 class="brand-name fw-bold mb-0 text-truncate">{{ $client->name }}</h6>
                    </div>
                </div>
            @empty
                <div class="px-2">
                    <div class="brand-item-card card border shadow-sm text-center rounded-3 bg-white p-3">
                        <div class="brand-img-wrapper mb-2">
                            <img src="{{ asset(general()->logo()) }}" alt="{{ general()->title }}" class="img-fluid brand-thumb">
                        </div>
                        <h6 class="brand-name fw-bold mb-0 text-truncate">{{ general()->title }}</h6>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Custom CSS Styling -->
<style>
    .brand-item-card {
        transition: all 0.3s ease;
        border-color: #eaeaea !important;
    }
    .brand-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        border-color: #6c757d !important;
    }
    .brand-img-wrapper {
        width: 100%;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .brand-thumb {
        max-height: 90px;
        width: 100%;
        object-fit: cover;
        border-radius: 6px;
    }
    .brand-name {
        font-size: 14px;
        letter-spacing: 0.5px;
        color: #333;
    }
</style>

<!-- Slick Slider Initialization -->
<script>
    $(document).ready(function(){
        $('.woman-fashion-brand-slider').slick({
            dots: false,
            infinite: true,
            speed: 400,
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            prevArrow: $('.brand-prev'),
            nextArrow: $('.brand-next'),
            responsive: [
                {
                    breakpoint: 1200,
                    settings: { slidesToShow: 4 }
                },
                {
                    breakpoint: 992,
                    settings: { slidesToShow: 3 }
                },
                {
                    breakpoint: 768,
                    settings: { slidesToShow: 2 }
                },
                {
                    breakpoint: 480,
                    settings: { slidesToShow: 2 }
                }
            ]
        });
    });
</script>


<!-- brand section start -->
{{--<div class="brandPart">
    <div class="container">
        <ul>
            <li>
                <img src="{{asset('welcome/images/brand-01.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-02.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-03.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-04.png')}}" alt="AJL Sea Food" />
            </li>
            <li>
                <img src="{{asset('welcome/images/brand-05.png')}}" alt="AJL Sea Food" />
            </li>
        </ul>
    </div>
</div>--}}
<!-- brand section end -->

@endsection @push('js') @endpush