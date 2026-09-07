@extends(welcomeTheme().'layouts.app') 
@section('title')
<title>{{websiteTitle('My WishList')}}</title>
@endsection 
@section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('My WishList')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('myWishlist')}}" />
<link rel="canonical" href="{{route('myWishlist')}}">
@endsection 
<style>

.page-content{
    padding: 50px 0;
}
.cart-summary.mb-4 {
    padding: 20px;
    background-color: #f8f9f9;
}
.mywishList {
    width: 80%;
    margin: 0 auto;
    background-color: #d7e5ff;
    padding: 20px;
    box-shadow: 0 0 20px #eee;
}
.shop-table .product-thumbnail {
    width: 11rem;
    padding-right: 1rem;
}

.shop-table td {
    border: 1px solid #ccc;
    font-size: 13px;
}
thead tr th {
    text-align: center;
    padding: 10px;
    border: 1px solid #ccc;
}
.mywishList table {
    width: 100%;
}
td.product-name a {
    color: #212529;
    text-align: center;
    display: block;
    font-size: 13px;
}
.product-price .new-price {
    font-size: 13px;
    text-align: center;
}
.p-relative {
    position: relative !important;
}
.shop-table .btn-close {
    position: absolute;
    padding: 0;
    background: #fff;
    border: 2px solid #fff;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.4);
    top: 10px;
    right: 10px;
}
a.btn.btn-dark.btn-rounded.btn-sm.ml-lg-2.btn-cart {
    text-align: center;
    margin: 0px auto;
    display: block;
    width: 75%;
}
td.product-stock-status {
    text-align: center;
}
td.product-stock-status span {
    padding: 2px 7px;
    border-radius: 5px;
}
.p-relative img {
    display: block;
    width: 35%;
    margin: 0px auto;
}
td.product-price {
    text-align: center;
    font-size: 13px;
}
.social-icons {
    margin: 20px 0;
}
.social-no-color .social-icon {
    color: #fff !important;
}
.btn-quickview {
    background-color: #fff !important;
    border-color: #fff !important;
}

figure{
    margin: 0!important;
}
</style>

@push('css')
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">My Wishlist</h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->

<div class="page-content">
    <div class="container">
        <div class="mywishList">
            @include(general()->theme.'.carts.includes.wishlistItems')
        </div>
    </div>
</div>

@endsection @push('js') @endpush