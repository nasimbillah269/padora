@extends('admin.layouts.app') @section('title')
<title>{{websiteTitle('Invoice')}}</title>
@endsection @push('css')

<style type="text/css">
    .invoice-inner {
        /*box-shadow: 0px 0px 5px #ccc;*/
        padding: 10px 20px;
    }

    .invoice-header {
        padding: 20px 0px 35px;
    }

    .invoice-header h6 {
        margin-top: 15px !important;
    }

    .invoice-header h6,
    p {
        margin: 0;
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

    tr.headerTable {
        background-color: #e2e2e2;
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

@endpush @section('contents')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Invoice</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Invoice</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <a class="btn btn-outline-primary" href="{{route('admin.orders')}}">Back</a>

            <a class="btn btn-outline-primary" href="{{route('admin.ordersManage',$order->id)}}">Manage</a>

            <button class="btn btn-success" id="PrintAction"><i class="fa fa-print"></i> Print</button>

            <a class="btn btn-outline-primary" href="{{route('admin.invoice',$order->id)}}">
                <i class="fa-solid fa-rotate"></i>
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <!-- Basic Elements start -->
    <section class="basic-elements">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-9">
                <div class="card">
                    <div class="invoice-inner invoicePage PrintAreaContact">
                        <div class="invoiceContainer">
                            <div class="invoice-inner InnerInvoiePage">
                                <div class="invoice-header">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{asset(general()->logo())}}" style="max-width: 100%;" />
                                        </div>
                                        <div class="col-1"></div>
                                        <div class="col-7" style="text-align: end;">
                                            <h6>CONTACT INFORMATION:</h6>
                                            <p>{{general()->address_one}}</p>
                                            <p>{{general()->mobile}}</p>
                                            <p>{{general()->email}}</p>
                                            <p>{{general()->website}}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr style="border: 2px solid #00549e; margin: 0;" />
                                <h2 style="margin: 10px 0px; font-size: 41px; letter-spacing: 3px; color: #00549e;">INVOICE</h2>
                                <div class="orderInfo">
                                    <div class="row" style="flex-wrap: wrap;">
                                        <div class="col-3">
                                            <p>
                                                <b>Order To:</b><br />
                                                <b>Name:</b> {{ $order->name }}<br />
                                                <b>Mobile:</b> {{ $order->mobile }}<br />
                                                <b>Address:</b> {{ $order->fullAddress() }}
                                            </p>
                                        </div>
                                        <div class="col-3"></div>
                                        <div class="col-6">
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
                                                            <td>: {{ucfirst($order->order_status=='temp'?'Incomplete':$order->order_status)}}</td>
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
                                    <div class="mainTable" style="margin: 30px 0;">
                                        <table class="table mainproducttable">
                                            <thead>
                                                <tr class="headerTable">
                                                    <td style="width: 40%;">Product Name & Description</td>
                                                    <td style="width: 10%; text-align: center;">Unit Price</td>
                                                    <td style="width: 15%; text-align: center;">Quantity</td>
                                                    <td style="width: 15%; text-align: center;">Total Price</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->items as $i=>$item)
                                                <tr>
                                                    <td>{{ $item->product_name }} @if($item->size) <b>Size:</b> {{$item->size}} @endif @if($item->color) <b>Color:</b> {{$item->color}} @endif</td>
                                                    <td style="text-align: center;">{{ priceFormat($item->price) }}</td>
                                                    <td style="text-align: center;">{{$item->quantity}}</td>
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
                                    <div class="row" style="display: flex;">
                                        <div class="col-md-12" style="">
                                            @if($order->payment_status=='paid')
                                            <div class="paidsStatus" style="text-align: right;">
                                                <img src="{{asset('medies/paid.png')}}" style="max-width: 80px;" />
                                            </div>
                                            @endif
                                        </div>
                                        @if($order->note)
                                        <div class="col-12">
                                            <b>Order Note</b><br />
                                            <p>{!!$order->note!!}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="footerInvoice">
                                    <div class="row" style="dispaly: flex;">
                                        <div class="col-6" style="flex: 0 0 50%; max-width: 50%;">
                                            <p>Thank you for shopping from {{general()->title}}</p>
                                        </div>
                                        <div class="col-6" style="text-align: end; flex: 0 0 50%; max-width: 50%;">
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
    </section>
    <!-- Basic Inputs end -->
</div>

@endsection @push('js') @endpush