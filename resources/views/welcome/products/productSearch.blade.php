@extends(general()->theme.'.layouts.app') @section('title')
<title>Search Product - {{general()->title}}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:image" content="{asset(general()->logo())}" />
<meta property="og:url" content="{{route('productSearch')}}" />
@endsection @push('css')
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">Search Result</h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->

<div class="categoryPage">
    <div class="container">
        <div class="products-section">
            <div class="featured-products">
                <div class="product-grids categoryProductGrid">
                    @if($products->count() > 0)
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-3 col-6" style="padding: 10px;">
                            @include(general()->theme.'.products.includes.productCard')
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="">
                        <h3 style="color:white;">No Result Found</h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 

@push('js') 

@endpush