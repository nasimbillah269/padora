@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Cart Items')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Cart Items')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keyword" property="og:keyword" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('carts')}}" />
<link rel="canonical" href="{{route('carts')}}" />
@endsection @push('css')

<style>
    form.coupon {
        padding: 20px;
        background-color: #839eff;
        box-shadow: 0px 0px 20px #eee;
    }

    a.btn.btn-block.btn-dark.btn-icon-right.btn-rounded.btn-checkout {
        margin-top: 20px;
    }
    .page-content {
        padding: 50px 0;
    }
    figure {
        margin: 0;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    textarea:focus, input:focus{
    outline: none;
    }
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    .wishlist-table .wishlist-action {
        width: 24.19%;
        text-align: left;
    }

    .cart-subtotal.d-flex.align-items-center.justify-content-between {
        border: 1px solid #ccc;
        padding: 5px 10px;
        margin: 5px 0;
        font-size: 14px;
    }

    .cart-summary {
        padding: 20px;
        background-color: #e0e7ff;
        box-shadow: 0px 0px 20px #f2f2f2;
    }

    .table-responsive {
        background-color: #e0e7ff;
        padding: 20px;
        display: block;
        box-shadow: 0px 0px 20px #eeee;
    }
    .shop-table .product-thumbnail {
        width: 25%;
        padding: 10px;
    }

    .product-thumbnail img {
        width: 30%;
    }

    .shop-table td {
        border-top: 1px solid #eee;
        font-size: 13px;
    }

    .shop-table thead tr th {
        text-align: center;
        padding: 10px;
    }

    .shop-table tbody tr td {
        text-align: center;
        padding: 10px;
    }

    .product-price .new-price {
        color: #fff !important;
    }

    td.product-name a {
        color: #212529;
        font-size: 13px;
    }

    span.amount {
        font-size: 14px;
    }

    .mywishList table tr, td, th {
        border: 1px solid #ccc;
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
        top: 0;
        right: 0px;
    }

    td.product-quantity button {
        background-color: #fff;
        border: 1px solid lightgray;
        padding: 2px 7px;
    }

    td.product-stock-status {
        text-align: center;
    }

    td.product-price {
        text-align: center;
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

    .cart-action a {
        background-color: #118ec9;
        border: none;
        display: inline-block;
        margin: 30px 0;
        border-radius: 0;
    }

    figure {
        margin: 0;


    .coupon button {
        background-color: #118ec9;
        border: none;
    }

    .cart-summary a {
        background-color: #118ec9;
        border: none;
        display: inline-block;
        margin-top: 20px;
    }
    
</style>


<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "Cart View",
        page_url: "{{route('carts')}}"
    });
</script>

@endpush 
@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">Cart</h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->

<div class="page-content">
    <div class="container">
        @include(welcomeTheme().'.alerts')
        <div class="row gutter-lg mb-10 cartItemsAll">
            @include(welcomeTheme().'carts.includes.cartItems')
        </div>
    </div>
</div>

@endsection @push('js')

<script>
    $(document).ready(function () {
        $(document).on("change", ".cartQtyChange", function () {
            var url = $(this).data("url");
            var qty = $(this).val();
            var Dcharge = parseInt($(".cartDeliveryCharge").text());

            if (isNaN(Dcharge)) {
                Dcharge = 0;
            }

            if (qty == "") {
                qty = 1;
            }

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                cache: false,
                data: { qty: qty },
            })
                .done(function (data) {
                    $(".cartItemsList").empty().append(data.cartItems);
                    $(".headerCartItem").empty().append(data.headerCartItems);
                })
                .fail(function () {
                    // alert("error");
                });
        });
    });
</script>

@endpush