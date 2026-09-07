@extends(welcomeTheme().'layouts.app')

@php
    $lpTitle = isset($page) && $page ? ($page->seo_title ?: $page->name) : 'Latest Products';
    $lpName  = isset($page) && $page ? $page->name : 'Latest Products';
    $lpUrl   = isset($page) && $page ? route('pageView', $page->slug ?: 'no-title') : url()->current();
    $lpDesc  = isset($page) && $page && $page->seo_description ? $page->seo_description : general()->meta_description;
    $lpKey   = isset($page) && $page && $page->seo_keyword ? $page->seo_keyword : general()->meta_keyword;
@endphp

@section('title')
<title>{{ websiteTitle($lpTitle) }}</title>
@endsection

@section('SEO')
<meta name="title" property="og:title" content="{{ websiteTitle($lpTitle) }}" />
<meta name="description" property="og:description" content="{!! $lpDesc !!}" />
<meta name="keywords" content="{{ $lpKey }}" />
<meta name="image" property="og:image" content="{{ asset(general()->favicon()) }}" />
<meta name="url" property="og:url" content="{{ $lpUrl }}" />
<link rel="canonical" href="{{ $lpUrl }}">
@endsection

@push('css')
<style>
    .latest-products-page { margin: 24px 0 48px; }
    .latest-products-page .lp-head {
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 10px; margin-bottom: 20px;
    }
    .latest-products-page .lp-head h1 {
        font-size: 24px; font-weight: 800; color: #16281d; margin: 0;
    }
    .latest-products-page .lp-count { font-size: 14px; color: #7a7487; }
    .latest-products-page .lp-grid { margin: 0 -10px; }
    .latest-products-page .lp-grid > [class*="col-"] { padding: 10px; }
    .latest-products-page .lp-empty { text-align: center; padding: 60px 15px; color: #7a7487; }

    @media (max-width: 575.98px){
        .latest-products-page .lp-head h1 { font-size: 20px; }
    }
</style>
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "latest Product",
        page_title: "{{ $lpName }}",
        page_url: "{{ $lpUrl }}"
    });

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
@endpush

@section('contents')

<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $lpName }}</li>
        </ol>
    </div>
</nav>

<div class="latest-products-page">
    <div class="container">

        <div class="lp-head">
            <h1>{{ $lpName }}</h1>
            <span class="lp-count">{{ $products->total() }} product(s)</span>
        </div>

        <div class="row lp-grid">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    @include(welcomeTheme().'products.includes.productCard')
                </div>
            @empty
                <div class="col-12">
                    <div class="lp-empty"><h5>No products found.</h5></div>
                </div>
            @endforelse
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-4">
                {{ $products->links('pagination') }}
            </div>
        </div>

    </div>
</div>

@endsection

@push('js')
@endpush
