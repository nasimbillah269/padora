@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Invoice')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Invoice')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.orderDetails',$order->invoice)}}" />
<link rel="canonical" href="{{route('customer.orderDetails',$order->invoice)}}">
@endsection 
@push('css')

<style type="text/css">

    .invoice-header {
        padding: 20px 0px 35px;
    }
    .invoice-header img{
        width: 100%;
    }
    .invoice-header h6, p{
        margin: 0;
        line-height: 16px;
    }
    
    .invoice-inner h2{
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
    
    .tableOrderinfo td{
        padding: 0;
        line-height: 17px;
        border: none;
    }
    
    .mainTable{
        margin: 30px 0;
    }
    
    .mainproducttable{
        margin: 0;
        padding: 0;
        width: 100%;
    }
    
    .mainproducttable td{
        padding: 5px 7px;
        border: 1px solid #ccc;
    }
    
    tr.headerTable td{
        padding: 7px;
    }
    
    .boxFrozen {
        border: 1px solid #ccc;
        text-align: center;
        margin-bottom: 6px;
        border-bottom: 0px solid #ccc;
    }
    
    .boxFrozen h3{
        padding: 5px;
        color: #fff;
        margin: 0;
        background-color: #ff1414;
        font-size: 16px;
    }
    
    .boxFrozen p{
        font-size: 16px;
        padding: 5px 0px;
        border-bottom: 1px solid #ccc;
    }
    
    .footerInvoice{
        margin-top: 100px;
    }
    
    .my-account .nav-link, .my-account .link-item {
        margin-bottom: 0 !important;
        padding: 1.7rem 0 1.6rem !important;
        font-size: 1.6rem !important;
        text-transform: none !important;
        border-bottom: 1px solid #e6903f !important;
    }
    
    .nav-link {
        color: #fff !important;
    }
    .link-item a.active {
        color: #e89340 !important;
    }
    
    .invoice-inner {
        background-color: #191a1c;
        padding: 20px;
    }
    
    .invoice-inner {
        background-color: #f7f7f7;
        padding: 20px;
        margin: 30px 0;
    }

    @media only screen and (max-width: 567px) {
        .invoice-inner {
            padding: 10px;
            margin: 10px 0px;
            
        }
        .invoiceContainer{
            padding:0;
        }
    }
</style>

@endpush @section('contents')

@include(welcomeTheme().'.customer.includes.pageHeader', ['pageTitle' => 'Order Details'])

<div class="userdashboard">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">
            @include(welcomeTheme().'.customer.includes.sidebar')
            <div class="tab-content">
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
                                                <td>{{ $item->product_name }}
                                                @if($item->size)
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
                                                <td colspan="3" style="text-align: end;">Discount</td>
                                                <td style="text-align: center;">{{ priceFormat($order->coupon_discount) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">VAT</td>
                                                <td style="text-align: center;">{{ priceFormat($order->tax) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Shipping</td>
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
                                    <div class="col-md-5"></div>
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


@endsection @push('js')

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"></script>
    <script src="{{asset('admin/app-assets/js/printThis.js')}}"></script>

<script type="text/javascript">
	$('#PrintAction').on("click", function () {
        $('.PrintAreaContact').printThis();
    });
</script>

@endpush
