@extends(general()->theme.'.layouts.app') @section('title')
<title>{{general()->title}} | {{general()->subtitle}}</title>
@endsection @section('SEO')
<meta name="description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta property="og:title" content="{{general()->meta_title}}" />
<meta property="og:description" content="{!!general()->meta_description!!}" />
<meta property="og:image" content="{!!general()->meta_description!!}" />
<meta property="og:url" content="{{route('index')}}" />
@endsection @push('css')
<style type="text/css">
    .invoice-inner {
        padding: 10px 20px;
        box-shadow: 0 0 20px #eee;
        margin-bottom: 20px;
    }

    .invoice-header {
        padding: 20px 0px 35px;
    }

    .invoice-header img {
        width: 100%;
    }

    .invoice-header h6 {
        margin-top: 15px !important;
    }

    .invoice-header h6, p {
        margin: 5px 0;
        line-height: 15px;
        font-size: 12px;
    }

    .invoice-inner h2 {
        margin: 10px 0px;
        font-size: 41px;
        letter-spacing: 3px;
        color: #00549e;
    }

    .ordrinfotable {
        padding: 10px 12px;
        border: 1px solid #ccc;
    }

    table.tableOrderinfo.table {
        margin: 0;
        padding: 0;
    }

    .tableOrderinfo td {
        padding: 0;
        font-size: 13px;
        line-height: 17px;
        border: none;
    }

    .mainTable {
        margin: 30px 0;
    }

    .mainproducttable {
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .mainproducttable td {
        padding: 5px 7px;
        font-size: 12px;
        border: 1px solid #ccc;
    }

    tr.headerTable td {
        font-size: 13px;
        padding: 7px;
    }

    .boxFrozen {
        border: 1px solid #ccc;
        text-align: center;
        margin-bottom: 6px;
        border-bottom: 0px solid #ccc;
    }

    .boxFrozen h3 {
        padding: 5px;
        color: #fff;
        margin: 0;
        background-color: #ff1414;
        font-size: 16px;
    }

    .boxFrozen p {
        font-size: 16px;
        padding: 5px 0px;
        border-bottom: 1px solid #ccc;
    }

    .footerInvoice {
        margin-top: 100px;
    }

    @media print {
        tr.headerTable td {
            border-color: red;
        }
    }

    @media only screen and (max-width: 567px) {
        .invoice-inner {
            padding: 10px;
            margin: 10px 0px;
        }
        .invoiceContainer {
            padding: 0;
        }
    }
</style>

<script>

   @if($purchases)
    window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            event: "purchase",
            ecommerce: {
                currency: "{{ general()->currency }}",
                value: {{ round($order->grand_total)}},
                vat: {{ round($order->tax ?? 0) }},
                shipping: {{ round($order->shipping_charge ?? 0) }},
                discount: {{ round($order->coupon_discount ?? 0) }},
                items: [
                    @foreach($order->items as $item)
                    {
                        @if($product =$item->product)
                        item_id: "{{$product->id}}",
                        item_name: "{{ $product->name }}",
                        item_category: "{!! implode(' - ', $product->productCategories->pluck('name')->toArray()) !!}",
                        item_brand: "{{ $product->brand ? $product->brand->name : '' }}",
                        price: "{{ round($item->price) }}",
                        quantity: "{{ $item->quantity }}",
                    
                        @endif
                    }@if(!$loop->last),@endif
                    @endforeach
                ]
            },
            customer: {
            name: "{{ $order->name }}",
            email: "{{ $order->email }}",
            mobile: "{{ $order->mobile }}",
            address: {
                street: "{{ $order->address}}",
                city: "{{ $order->cityN?$order->cityN->name:'' }}",
                state: "{{ $order->districtN?$order->districtN->name:'' }}",
                postal_code: "{{$order->postal_code}}",
                country: "Bangladesh",
            }
        }
    });
    @endif

</script>
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">My Invoice </h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->

<div class="main-home-page">
    <div class="container">
        <div class="cart-page">
            <div class="Invoice-table">
                <div class="row" style="margin: 0;">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8" style="padding: 0;">
                        <p style="text-align: center;">
                            <span id="PrintAction" style="margin: 5px; display: inline-block; background: red; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Print</span>
                        </p>
                        <div class="invoicePage PrintAreaContact">
                            <style>
                                @media print {
                                    .invoice-inner{
                                        background-color: #fff;
                                        padding: 30px ;
                                        margin: 30px 0;
                                        height: 100%;
                                    }
                                    .invoice-header{
                                        margin-bottom: 25px;
                                    }
                                    .invoice-header h6,
                                    p {
                                        margin: 0;
                                        line-height: 15px;
                                        font-size: 12px;
                                        color: black;
                                    }
                                    
                                    .mainTable{
                                        margin: 20px 0 100px;
                                    }
                                    
                                    .invoice-header h6, p {
                                        margin: 5px 0!important;
                                    }
                                    
                                    .mainproducttable td {
                                        border: 1px solid #c1c1c1;
                                        padding: 5px;
                                    }
                                    
                                    .invoice-header img {
                                        border-radius: 5px !important;
                                    }
                                    
                                    .invoice-inner h2 {
                                        color: #000!important;
                                        margin-top: 15px!important;
                                    }
                                    
                                    .tableOrderinfo td, tr{
                                        color: #000!important;
                                    }
                                }
                            </style>
                            <div class="container invoiceContainer">
                                <div class="invoice-inner">
                                    <div class="invoice-header">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{asset(general()->logo())}}" />
                                            </div>
                                            <div class="col-1"></div>
                                            <div class="col-7" style="text-align: end;">
                                                <h6>CONTACT INFORMATION:</h6>
                                                <p>{{general()->address_one}}</p>
                                                <p>{{general()->mobile}}</p>
                                                <p>{{general()->website}}</p>
                                                <p>{{general()->email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="border: 2px solid #00549e; margin: 0;" />
                                    <h2 class="headTi">INVOICE</h2>
                                    <div class="orderInfo">
                                        <div class="row">
                                            <div class="col-7 mt-3">
                                                <p>Order From:</p>
                                                <p><b>Name:</b> {{$order->name}}</p>
                                                <p><b>Mobile:</b> {{$order->mobile}}</p>
                                                <p><b>Email:</b> {{$order->email}}</p>
                                                <p><b>Shipping:</b> {{$order->fullAddress()}}</p>
                                            </div>
                                            <div class="col-5">
                                                <div class="ordrinfotable">
                                                    <table class="tableOrderinfo table">
                                                        <thead>
                                                            <tr>
                                                                <td style="width: 40%;">Invoice Number</td>
                                                                <td>: {{ $order->invoice }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 40%;">Invoice Date</td>
                                                                <td>: {{ $order->created_at->format('d-m-Y h:i A') }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 40%;">Order Status</td>
                                                                <td>: {{ucfirst($order->order_status)}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 40%;">Payment Method</td>
                                                                <td>: {{ucfirst($order->payment_method)}}</td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <div class="mainTable">
                                            <table class="table mainproducttable">
                                                <thead>
                                                    <tr class="headerTable">
                                                        <td style="width: 60%;">Product Name & Description</td>
                                                        <td style="width: 15%; text-align: center;">Quantity</td>
                                                        <td style="width: 10%; text-align: center;">Unit Price</td>
                                                        <td style="width: 15%; text-align: center;">Total Price</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $i=>$item)
                                                    <tr>
                                                        <td>{{ $item->product_name }}  @if($item->size)
                                                            <b>Size:</b> {{$item->size}}
                                                            @endif
                                                            @if($item->color)
                                                            <b>Color:</b> {{$item->color}}
                                                            @endif
                                                        </td>
                                                        <td style="text-align: center;">{{$item->quantity}}</td>
                                                        <td style="text-align: center;">{{ priceFormat($item->price) }}</td>
                                                        <td style="text-align: center;">{{ priceFormat($item->final_price) }}</td>
                                                    </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="3" style="text-align: end;">Subtotal</td>
                                                        <td style="text-align: center;">{{ priceFormat($order->total_price) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="text-align: end;">VAT</td>
                                                        <td style="text-align: center;">{{ priceFormat($order->tax) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="text-align: end;">Discount</td>
                                                        <td style="text-align: center;">{{ priceFormat($order->coupon_discount) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="text-align: end;">Shipping
                                                        @if($order->isDhaka()=='no')
                                                        <span style="color: #c1bcbc;">
                                                            (Cocksheet + courier)
                                                        </span>
                                                        @endif
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if($order->shipping_charge>0) {{priceFormat($order->shipping_charge)}} @else Free Shipping @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="text-align: end;">Grand Total</td>
                                                        <td style="text-align: center;">{{ priceFormat($order->grand_total) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="frozenTable">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <p>Note: {{$order->note}}</p>
                                            </div>
                                            <div class="col-md-7">
                                                @if($order->payment_status=='paid')
                                                <div class="paidsStatus" style="text-align: center;">
                                                    <img src="{{asset('medies/paid.png')}}" style="max-width: 120px;" />
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="footerInvoice">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Thank you for shopping from {{general()->title}}</p>
                                            </div>
                                            <div class="col-md-6" style="text-align: end;">
                                                ------------------------
                                                <p>Authorised Sign</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection @push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"></script>
    <script src="{{asset('admin/app-assets/js/printThis.js')}}"></script>

    <script type="text/javascript">
        $("#PrintAction").on("click", function () {
            $(".PrintAreaContact").printThis();
        });
    </script>

    @endpush
</div>