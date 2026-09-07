@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle('My Compare list')}}</title>
@endsection 
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('My Compare list')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('myCompare')}}" />
<link rel="canonical" href="{{route('myCompare')}}">
@endsection 
@push('css')
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0">Compare</h1>
    </div>
</div>
<!-- End of Page Header -->

<!-- Start of Breadcrumb -->
<nav class="breadcrumb-nav mb-10">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home </a></li>
            <li>Compare</li>
        </ul>
    </div>
</nav>
<!-- End of Breadcrumb -->

<div class="page-content mb-10 pb-2">
    <div class="container">
        <div class="compare-table">
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-products">
                <div class="compare-col compare-field">Product</div>
                <div class="compare-col compare-product">
                    <a href="#" class="btn remove-product"><i class="w-icon-times-solid"></i></a>
                    <div class="product text-center">
                        <figure class="product-media">
                            <a href="product-default.html">
                                <img src="{{asset('welcome/assets/images/products/elements/1.jpg')}}" alt="Product" width="228" height="257" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart w-icon-cart"></a>
                                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-name"><a href="product-default.html">Electronics Black Wrist Watch</a></h3>
                        </div>
                    </div>
                </div>
                <div class="compare-col compare-product">
                    <a href="#" class="btn remove-product"><i class="w-icon-times-solid"></i></a>
                    <div class="product text-center">
                        <figure class="product-media">
                            <a href="product-default.html">
                                <img src="{{asset('welcome/assets/images/products/elements/2.jpg')}}" alt="Product" width="228" height="257" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart w-icon-cart"></a>
                                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-name"><a href="product-default.html">Summer Sport Shoes</a></h3>
                        </div>
                    </div>
                </div>
                <div class="compare-col compare-product">
                    <a href="#" class="btn remove-product"><i class="w-icon-times-solid"></i></a>
                    <div class="product text-center">
                        <figure class="product-media">
                            <a href="product-default.html">
                                <img src="{{asset('welcome/assets/images/products/elements/3.jpg')}}" alt="Product" width="228" height="257" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart w-icon-cart"></a>
                                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-name"><a href="product-default.html">Charming Design Watch</a></h3>
                        </div>
                    </div>
                </div>
                <div class="compare-col compare-product">
                    <a href="#" class="btn remove-product"><i class="w-icon-times-solid"></i></a>
                    <div class="product text-center">
                        <figure class="product-media">
                            <a href="product-default.html">
                                <img src="{{asset('welcome/assets/images/products/elements/4-1.jpg')}}" alt="Product" width="228" height="257" />
                            </a>
                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-cart w-icon-cart"></a>
                                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-name"><a href="product-default.html">Populated Gaming Mouse</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Compare Products -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-price">
                <div class="compare-col compare-field">Price</div>
                <div class="compare-col compare-value">
                    <div class="product-price">
                        <span class="new-price">$40.00</span>
                    </div>
                </div>
                <div class="compare-col compare-value">
                    <div class="product-price">
                        <span class="new-price">$86.00</span>
                        <span class="old-price">$120.00</span>
                    </div>
                </div>
                <div class="compare-col compare-value">
                    <div class="product-price">
                        <span class="new-price">$30.00</span>
                    </div>
                </div>
                <div class="compare-col compare-value">
                    <div class="product-price">
                        <span class="new-price">$236.00</span>
                    </div>
                </div>
            </div>
            <!-- End of Compare Price -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-availability">
                <div class="compare-col compare-field">Availability</div>
                <div class="compare-col compare-value">In stock</div>
                <div class="compare-col compare-value">In stock</div>
                <div class="compare-col compare-value">In stock</div>
                <div class="compare-col compare-value">In stock</div>
            </div>
            <!-- End of Compare Availability -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-description">
                <div class="compare-col compare-field">description</div>
                <div class="compare-col compare-value">
                    <ul class="list-style-none list-type-check">
                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                    </ul>
                </div>
                <div class="compare-col compare-value">
                    <ul class="list-style-none list-type-check">
                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                    </ul>
                </div>
                <div class="compare-col compare-value">
                    <ul class="list-style-none list-type-check">
                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                    </ul>
                </div>
                <div class="compare-col compare-value">
                    <ul class="list-style-none list-type-check">
                        <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                        <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                        <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                    </ul>
                </div>
            </div>
            <!-- End of Compare Description -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-reviews">
                <div class="compare-col compare-field">Ratings &amp; Reviews</div>
                <div class="compare-col compare-rating">
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 80%;"></span>
                            <span class="tooltiptext tooltip-top">4.00</span>
                        </div>
                        <a href="#" class="rating-reviews">(3 Reviews)</a>
                    </div>
                </div>
                <div class="compare-col compare-rating">
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 100%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#" class="rating-reviews">(5 Reviews)</a>
                    </div>
                </div>
                <div class="compare-col compare-rating">
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 60%;"></span>
                            <span class="tooltiptext tooltip-top">3.00</span>
                        </div>
                        <a href="#" class="rating-reviews">(8 Reviews)</a>
                    </div>
                </div>
                <div class="compare-col compare-rating">
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 80%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#" class="rating-reviews">(3 Reviews)</a>
                    </div>
                </div>
            </div>
            <!-- End of Compare Reviews -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-category">
                <div class="compare-col compare-field">Category</div>
                <div class="compare-col compare-value">Watches</div>
                <div class="compare-col compare-value">Shoes</div>
                <div class="compare-col compare-value">Watches</div>
                <div class="compare-col compare-value">Electronics</div>
            </div>
            <!-- End of Compare Category -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-meta">
                <div class="compare-col compare-field" style="color: #999;">SKU</div>
                <div class="compare-col compare-value" style="color: #999;">MS46891344</div>
                <div class="compare-col compare-value" style="color: #999;">MS46891389</div>
                <div class="compare-col compare-value" style="color: #999;">MS46891349</div>
                <div class="compare-col compare-value" style="color: #999;">MS4689158</div>
            </div>
            <!-- End of Compare Meta -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-color">
                <div class="compare-col compare-field">Color</div>
                <div class="compare-col compare-value">
                    <span class="swatch" style="background-color: #ff0000;" title="Red"></span>
                    <span class="swatch" style="background-color: #00ff00;" title="Red"></span>
                    <span class="swatch" style="background-color: #0000ff;" title="Red"></span>
                    <span class="swatch" style="background-color: #ecec23;" title="Red"></span>
                </div>
                <div class="compare-col compare-value">
                    <span class="swatch" style="background-color: #000000;" title="Red"></span>
                    <span class="swatch" style="background-color: #c0c0c0;" title="Red"></span>
                    <span class="swatch" style="background-color: #808080;" title="Red"></span>
                    <span class="swatch" style="background-color: #0080c0;" title="Red"></span>
                </div>
                <div class="compare-col compare-value">
                    <span class="swatch" style="background-color: #000000;" title="Red"></span>
                    <span class="swatch" style="background-color: #95e8e8;" title="Red"></span>
                    <span class="swatch" style="background-color: #fa0af3;" title="Red"></span>
                    <span class="swatch" style="background-color: #0a4bfa;" title="Red"></span>
                </div>
                <div class="compare-col compare-value">
                    <span class="swatch" style="background-color: #000000;" title="Red"></span>
                    <span class="swatch" style="background-color: #0000a0;" title="Red"></span>
                    <span class="swatch" style="background-color: #42fdf9;" title="Red"></span>
                    <span class="swatch" style="background-color: #9ba3a4;" title="Red"></span>
                </div>
            </div>
            <!-- End of Compare Color -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-size">
                <div class="compare-col compare-field" style="color: #999;">Size</div>
                <div class="compare-col compare-value" style="color: #999;">Medium, Small</div>
                <div class="compare-col compare-value" style="color: #999;">Large, Medium</div>
                <div class="compare-col compare-value" style="color: #999;">Small</div>
                <div class="compare-col compare-value" style="color: #999;">Medium</div>
            </div>
            <!-- End of Compare Size -->
            <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-brand">
                <div class="compare-col compare-field">Brand</div>
                <div class="compare-col compare-value">Apple</div>
                <div class="compare-col compare-value">New Balance</div>
                <div class="compare-col compare-value">Node Js</div>
                <div class="compare-col compare-value">Green Grass</div>
            </div>
            <!-- End of Compare Brand -->
        </div>
    </div>
    <!-- End of Compare Table -->
</div>

    
@endsection
@push('js')
@endpush