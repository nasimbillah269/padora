@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($category->seo_title?:$category->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($category->seo_title?:$category->name)}}" />
<meta name="description" property="og:description" content="{!!$category->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$category->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->favicon())}}" />
<meta name="url" property="og:url" content="{{route('productCategory',$category->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('productCategory',$category->slug?:'no-title')}}">
@endsection @push('css')
<style>
    :root {
        --shop-accent: #6b1e73;
        --shop-accent-soft: #f3e9f5;
        --shop-border: #ebe6ef;
        --shop-muted: #7a7487;
    }

    .category-shop { margin-top: 18px; }

    /* ---------- Toolbar above the product grid ---------- */
    .shop-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        background: #fff;
        border: 1px solid var(--shop-border);
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 18px;
    }
    .shop-toolbar .result-text { font-size: 14px; color: var(--shop-muted); margin: 0; }
    .shop-toolbar .result-text b { color: #2b2735; }
    .shop-toolbar-right { display: flex; align-items: center; gap: 10px; }

    .sort-field { position: relative; }
    .sort-field > i {
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        font-size: 12px; color: var(--shop-muted); pointer-events: none;
    }
    .sort-select {
        appearance: none; -webkit-appearance: none;
        border: 1px solid var(--shop-border);
        background: #fff;
        border-radius: 9px;
        padding: 9px 34px 9px 32px;
        font-size: 14px; color: #2b2735; font-weight: 600;
        cursor: pointer; min-width: 210px;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .sort-select:focus { outline: none; border-color: var(--shop-accent); box-shadow: 0 0 0 3px var(--shop-accent-soft); }
    .sort-field::after {
        content: ""; position: absolute; right: 14px; top: 50%;
        width: 7px; height: 7px; margin-top: -5px;
        border-right: 2px solid var(--shop-muted);
        border-bottom: 2px solid var(--shop-muted);
        transform: rotate(45deg); pointer-events: none;
    }

    .filter-toggle-btn {
        display: none;
        align-items: center; gap: 8px;
        border: 1px solid var(--shop-border);
        background: #fff; color: #2b2735;
        border-radius: 9px; padding: 9px 16px;
        font-size: 14px; font-weight: 600; cursor: pointer;
    }

    /* ---------- Sidebar ---------- */
    .filter-sidebar {
        background: #fff;
        border: 1px solid var(--shop-border);
        border-radius: 14px;
        padding: 20px;
        position: sticky;
        top: 20px;
    }
    .filter-sidebar .filter-head {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 6px;
    }
    .filter-sidebar .filter-head h5 { margin: 0; font-size: 17px; font-weight: 700; color: #2b2735; }
    .filter-sidebar .reset-link {
        font-size: 12.5px; font-weight: 600; color: var(--shop-accent);
        background: none; border: none; padding: 0; cursor: pointer;
    }
    .filter-sidebar .reset-link:hover { text-decoration: underline; }

    .filter-group { padding: 18px 0; border-bottom: 1px solid var(--shop-border); }
    .filter-group:last-child { border-bottom: none; padding-bottom: 4px; }
    .filter-group > .group-title {
        font-size: 12px; font-weight: 700; letter-spacing: .06em;
        text-transform: uppercase; color: var(--shop-muted);
        margin: 0 0 14px;
    }

    .filter-sidebar .form-check { padding-left: 0; margin-bottom: 11px; display: flex; align-items: center; }
    .filter-sidebar .form-check:last-child { margin-bottom: 0; }
    .filter-sidebar .form-check-input {
        float: none; margin: 0 10px 0 0;
        width: 18px; height: 18px;
        border: 1.5px solid #cfc7d6;
        cursor: pointer; flex-shrink: 0;
        accent-color: var(--shop-accent);
    }
    .filter-sidebar .form-check-input:checked {
        background-color: var(--shop-accent);
        border-color: var(--shop-accent);
    }
    .filter-sidebar .form-check-input:focus {
        box-shadow: 0 0 0 3px var(--shop-accent-soft); border-color: var(--shop-accent);
    }
    .filter-sidebar .form-check-label {
        font-size: 14px; color: #453f52; cursor: pointer; line-height: 1.3;
    }
    .filter-sidebar .form-check-label.is-active { color: var(--shop-accent); font-weight: 700; }

    /* Price range */
    .price-readout {
        display: flex; align-items: center; justify-content: space-between;
        font-size: 13.5px; font-weight: 600; color: #2b2735; margin-bottom: 12px;
    }
    .price-readout .chip {
        background: var(--shop-accent-soft); color: var(--shop-accent);
        border-radius: 7px; padding: 4px 10px;
    }
    input[type="range"].price-range {
        -webkit-appearance: none; appearance: none;
        width: 100%; height: 4px; border-radius: 4px;
        background: #e7e1ec; outline: none; margin: 6px 0 4px;
    }
    input[type="range"].price-range::-webkit-slider-thumb {
        -webkit-appearance: none; appearance: none;
        width: 18px; height: 18px; border-radius: 50%;
        background: var(--shop-accent); cursor: pointer;
        border: 3px solid #fff; box-shadow: 0 1px 5px rgba(107,30,115,.4);
    }
    input[type="range"].price-range::-moz-range-thumb {
        width: 15px; height: 15px; border-radius: 50%;
        background: var(--shop-accent); cursor: pointer; border: 3px solid #fff;
    }
    .price-inputs { display: flex; align-items: center; gap: 8px; margin-top: 12px; }
    .price-inputs .pi-box {
        flex: 1; display: flex; align-items: center; gap: 4px;
        border: 1px solid var(--shop-border); border-radius: 8px; padding: 6px 8px;
    }
    .price-inputs .pi-box span { color: var(--shop-muted); font-size: 13px; }
    .price-inputs .pi-box input {
        border: none; outline: none; width: 100%; font-size: 13.5px;
        color: #2b2735; background: transparent; -moz-appearance: textfield;
    }
    .price-inputs .pi-box input::-webkit-outer-spin-button,
    .price-inputs .pi-box input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .price-inputs .pi-sep { color: var(--shop-muted); }

    /* Product container loading state */
    #productContainer { transition: opacity .18s ease; position: relative; min-height: 200px; }
    #productContainer.is-loading { opacity: .45; pointer-events: none; }
    #productContainer.is-loading::after {
        content: ""; position: absolute; top: 60px; left: 50%; width: 34px; height: 34px;
        margin-left: -17px; border: 3px solid var(--shop-accent-soft);
        border-top-color: var(--shop-accent); border-radius: 50%;
        animation: shopspin .7s linear infinite;
    }
    @keyframes shopspin { to { transform: rotate(360deg); } }

    .active-filters { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 14px; }
    .active-filters .af-chip {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fff; border: 1px solid var(--shop-border);
        border-radius: 999px; padding: 5px 12px; font-size: 12.5px; color: #453f52;
    }
    .active-filters .af-chip button {
        border: none; background: none; color: var(--shop-muted);
        font-size: 13px; line-height: 1; cursor: pointer; padding: 0;
    }

    /* ---------- Mobile off-canvas ---------- */
    .filter-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,.5); z-index: 1040;
    }
    .filter-overlay.active { display: block; }

    @media (max-width: 991.98px) {
        .filter-toggle-btn { display: inline-flex; }
        .filter-sidebar {
            position: fixed; top: 0; left: -320px;
            width: 300px; height: 100vh; z-index: 1050;
            border-radius: 0; overflow-y: auto;
            box-shadow: 2px 0 18px rgba(0,0,0,.15);
            transition: left .28s ease-in-out;
        }
        .filter-sidebar.active { left: 0; }
        .filter-col { position: static; }
    }
    @media (min-width: 992px) {
        .filter-mobile-close { display: none; }
    }
    @media (max-width: 575.98px) {
        .sort-select { min-width: 0; width: 100%; }
        .shop-toolbar-right { width: 100%; }
        .sort-field { flex: 1; }
    }
</style>
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "category",
        page_title: "{{$category->name}}",
        page_url: "{{route('productCategory',$category->slug?:'no-title')}}"
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
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Home</a>
            </li>
            <li class="breadcrumb-item"><a href="">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $category->name ?? 'Women Clothing' }}
            </li>
        </ol>
    </div>
</nav>

<div class="page-content mb-10">
    <div class="container">
        @php
            $reqCategories = collect(explode(',', (string) request('categories')))->filter()->map(fn($v)=>(int)$v)->all();
            $reqStock      = request('stock_status', '');
            $reqSort       = request('sort', 'newest');
            $reqMin        = (int) request('min_price', 0);
            $reqMax        = request()->filled('max_price') ? (int) request('max_price') : (int) $maxProductPrice;
        @endphp

        <div class="category-shop" id="shopMain">

            <!-- Overlay for mobile drawer -->
            <div class="filter-overlay" id="filterOverlay"></div>

            <div class="row">
                <!-- ==================== Filter Sidebar ==================== -->
                <div class="col-lg-3 col-md-12 filter-col">
                    <div class="filter-sidebar" id="filterSidebar">

                        <div class="filter-head">
                            <h5>Filters</h5>
                            <button type="button" class="reset-link" id="resetFilters">Reset all</button>
                        </div>

                        <button type="button" class="btn-close filter-mobile-close position-absolute end-0 top-0 m-3" id="closeMobileFilter"></button>

                        <!-- Categories -->
                        <div class="filter-group">
                            <p class="group-title">Categories</p>
                            <div class="category-list">
                                @foreach($allCategories as $cat)
                                    @php $catChecked = in_array($cat->id, $reqCategories) || (empty($reqCategories) && isset($category) && $category->id == $cat->id); @endphp
                                    <div class="form-check">
                                        <input class="form-check-input filter-category"
                                               type="checkbox"
                                               value="{{ $cat->id }}"
                                               id="cat-{{ $cat->id }}"
                                               {{ $catChecked ? 'checked' : '' }}>
                                        <label class="form-check-label {{ $catChecked ? 'is-active' : '' }}" for="cat-{{ $cat->id }}">
                                            {{ $cat->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="filter-group">
                            <p class="group-title">Price Range</p>
                            <div class="price-readout">
                                <span>Selected</span>
                                <span class="chip" id="priceLabel">৳{{ $reqMin }} — ৳{{ $reqMax }}</span>
                            </div>
                            <input type="range" class="form-range price-range" id="price_range"
                                   min="0" max="{{ $maxProductPrice }}" step="50" value="{{ $reqMax }}">
                            <div class="price-inputs">
                                <div class="pi-box">
                                    <span>৳</span>
                                    <input type="number" id="price_min" min="0" max="{{ $maxProductPrice }}" value="{{ $reqMin }}" placeholder="Min">
                                </div>
                                <span class="pi-sep">—</span>
                                <div class="pi-box">
                                    <span>৳</span>
                                    <input type="number" id="price_max" min="0" max="{{ $maxProductPrice }}" value="{{ $reqMax }}" placeholder="Max">
                                </div>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="filter-group">
                            <p class="group-title">Availability</p>
                            <div class="form-check">
                                <input class="form-check-input filter-stock" type="radio" name="stock" value="" id="stock_all" {{ $reqStock === '' ? 'checked' : '' }}>
                                <label class="form-check-label" for="stock_all">All</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter-stock" type="radio" name="stock" value="in_stock" id="in_stock" {{ $reqStock === 'in_stock' ? 'checked' : '' }}>
                                <label class="form-check-label" for="in_stock">In Stock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input filter-stock" type="radio" name="stock" value="out_of_stock" id="out_of_stock" {{ $reqStock === 'out_of_stock' ? 'checked' : '' }}>
                                <label class="form-check-label" for="out_of_stock">Out of Stock</label>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ==================== Product Column ==================== -->
                <div class="col-lg-9 col-md-12">

                    <div class="shop-toolbar">
                        <button type="button" class="filter-toggle-btn" id="openMobileFilter">
                            <i class="fas fa-sliders-h"></i> Filters
                        </button>

                        <p class="result-text">
                            Showing <b id="resultCount">{{ $products->total() }}</b> product(s)
                            in <b>{{ $category->name }}</b>
                        </p>

                        <div class="shop-toolbar-right">
                            <div class="sort-field">
                                <i class="fas fa-sort-amount-down"></i>
                                <select class="sort-select" id="sortSelect">
                                    <option value="newest"     {{ $reqSort === 'newest' ? 'selected' : '' }}>Newest first</option>
                                    <option value="price_low"  {{ $reqSort === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ $reqSort === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="name_asc"   {{ $reqSort === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                    <option value="oldest"     {{ $reqSort === 'oldest' ? 'selected' : '' }}>Oldest first</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="productContainer">
                        @include(welcomeTheme().'products.includes.productList')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@push('js')
<script>
$(function () {
    var baseUrl = @json(route('productCategory', $category->slug ?: 'no-title'));
    var ceiling = {{ (int) $maxProductPrice }};
    var debounceTimer = null;

    function clampInt(v, min, max) {
        v = parseInt(v, 10);
        if (isNaN(v)) v = min;
        if (v < min) v = min;
        if (v > max) v = max;
        return v;
    }

    function syncPriceUI(fromSlider) {
        var mn = clampInt($('#price_min').val(), 0, ceiling);
        var mx = clampInt($('#price_max').val(), 0, ceiling);
        if (fromSlider) { mx = clampInt($('#price_range').val(), 0, ceiling); }
        if (mn > mx) { mn = mx; }
        $('#price_min').val(mn);
        $('#price_max').val(mx);
        $('#price_range').val(mx);
        $('#priceLabel').text('৳' + mn + ' — ৳' + mx);
    }

    function collectFilters() {
        var categories = $('.filter-category:checked').map(function () { return this.value; }).get();
        return {
            categories:   categories.join(','),
            min_price:    clampInt($('#price_min').val(), 0, ceiling),
            max_price:    clampInt($('#price_max').val(), 0, ceiling),
            stock_status: $('.filter-stock:checked').val() || '',
            sort:         $('#sortSelect').val() || 'newest'
        };
    }

    function updateUrl(params) {
        if (!window.history || !window.history.replaceState) return;
        var qs = $.param(Object.keys(params).reduce(function (acc, k) {
            if (params[k] !== '' && params[k] !== null && typeof params[k] !== 'undefined') acc[k] = params[k];
            return acc;
        }, {}));
        window.history.replaceState(null, '', qs ? (baseUrl + '?' + qs) : baseUrl);
    }

    function filterProducts(page) {
        page = page || 1;
        var params = collectFilters();
        var data = $.extend({}, params, { page: page });

        $('#productContainer').addClass('is-loading');

        $.ajax({
            url: baseUrl,
            type: 'GET',
            data: data,
            success: function (res) {
                $('#productContainer').html(res.html).removeClass('is-loading');
                if (typeof res.count !== 'undefined') $('#resultCount').text(res.count);
                updateUrl(params);

                // close the mobile drawer if open
                $('#filterSidebar').removeClass('active');
                $('#filterOverlay').removeClass('active');
                $('body').css('overflow', '');

                var top = $('#shopMain').offset().top - 90;
                if ($(window).scrollTop() > top) {
                    $('html, body').animate({ scrollTop: top }, 250);
                }
            },
            error: function () {
                $('#productContainer').removeClass('is-loading');
            }
        });
    }

    function debouncedFilter() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () { filterProducts(1); }, 350);
    }

    /* ---- events ---- */
    $(document).on('change', '.filter-category', function () {
        $(this).closest('.form-check').find('.form-check-label').toggleClass('is-active', this.checked);
        filterProducts(1);
    });

    $(document).on('change', '.filter-stock', function () { filterProducts(1); });
    $(document).on('change', '#sortSelect', function () { filterProducts(1); });

    $(document).on('input', '#price_range', function () { syncPriceUI(true); });
    $(document).on('change', '#price_range', function () { syncPriceUI(true); debouncedFilter(); });

    $(document).on('input', '#price_min, #price_max', function () { syncPriceUI(false); });
    $(document).on('change', '#price_min, #price_max', function () { syncPriceUI(false); debouncedFilter(); });

    $('#resetFilters').on('click', function (e) {
        e.preventDefault();
        $('.filter-category').prop('checked', false).closest('.form-check').find('.form-check-label').removeClass('is-active');
        $('#stock_all').prop('checked', true);
        $('#price_min').val(0);
        $('#price_max').val(ceiling);
        $('#sortSelect').val('newest');
        syncPriceUI(false);
        filterProducts(1);
    });

    /* pagination inside the ajax-loaded list */
    $(document).on('click', '#paginationLinks a', function (e) {
        e.preventDefault();
        var href = $(this).attr('href') || '';
        var page = 1;
        try {
            page = new URL(href, window.location.origin).searchParams.get('page') || 1;
        } catch (err) {
            var m = href.match(/[?&]page=(\d+)/);
            if (m) page = m[1];
        }
        filterProducts(page);
    });

    /* mobile drawer */
    $('#openMobileFilter').on('click', function () {
        $('#filterSidebar').addClass('active');
        $('#filterOverlay').addClass('active');
        $('body').css('overflow', 'hidden');
    });
    $(document).on('click', '#closeMobileFilter, #filterOverlay', function () {
        $('#filterSidebar').removeClass('active');
        $('#filterOverlay').removeClass('active');
        $('body').css('overflow', '');
    });

    syncPriceUI(false);
});
</script>
@endpush
