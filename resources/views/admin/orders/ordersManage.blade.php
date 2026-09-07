@extends('admin.layouts.app') @section('title')
<title>{{websiteTitle('Order Manage')}}</title>
@endsection @push('css')
<style type="text/css"></style>
@endpush @section('contents')

<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Order Manage</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard </a></li>
                    <li class="breadcrumb-item active">Order Manage</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="content-header-right col-md-6 col-12 mb-md-0 mb-2">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <a class="btn btn-outline-primary" href="{{route('admin.orders')}}"><i class="fa fa-list"></i> Back</a>

            <a class="btn btn-success" href="{{route('admin.invoice',$order->id)}}"><i class="fa fa-print"></i> Invoice</a>

            <a class="btn btn-outline-primary" href="{{route('admin.ordersManage',$order->id)}}">
                <i class="fa-solid fa-rotate"></i>
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <!-- Basic Elements start -->
    <section class="basic-elements">
        <div class="row">
            <div class="col-md-12">
                @include('admin.alerts')
                <div class="card">
                    <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                        <h4 class="card-title">Customer Info</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>INVOICE:</th>
                                                <td>{{$order->invoice}}</td>
                                            </tr>

                                            <tr>
                                                <th>Name:</th>
                                                <td>{{$order->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile:</th>
                                                <td>{{$order->mobile}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>{{$order->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>Billing:</th>
                                                <td>{{$order->fullAddress()}}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Note:</th>
                                                <td>{!!$order->note!!}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th>Grand Total:</th>
                                                <td>
                                                    {{priceFullFormat($order->grand_total)}} @if($order->return_amount>0)
                                                    <span class="badge badge-success" style="background: #ff9800;">Refund</span> {{priceFullFormat($order->return_amount)}} @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Paid:</th>
                                                <td>{{priceFullFormat($order->paid_amount)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Due:</th>
                                                <td>{{priceFullFormat($order->due_amount)}}</td>
                                            </tr>
                                            @if($order->extra_amount)
                                            <tr>
                                                <th>Advence:</th>
                                                <td>{{priceFullFormat($order->extra_amount)}}</td>
                                            </tr>
                                            @endif

                                            <tr>
                                                <th>Payment:</th>
                                                <td>
                                                    @if($order->payment_status=='partial')
                                                    <span class="badge badge-success" style="background: #ff9800;">{{ucfirst($order->payment_status)}}</span>
                                                    @elseif($order->payment_status=='paid')
                                                    <span class="badge badge-success" style="background: #673ab7;">{{ucfirst($order->payment_status)}}</span>
                                                    @else
                                                    <span class="badge badge-success" style="background: #f44336;">{{ucfirst($order->payment_status)}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Order Status:</th>
                                                <td>
                                                    @if($order->payment_method==null)
                                                    <span class="badge badge-success" style="background: #ff5722;">Pending Payment</span>
                                                    @else @if($order->order_status=='confirmed')
                                                    <span class="badge badge-success" style="background: #e91e63;">{{ucfirst($order->order_status)}}</span>
                                                    @elseif($order->order_status=='shipped')
                                                    <span class="badge badge-success" style="background: #673ab7;">{{ucfirst($order->order_status)}}</span>
                                                    @elseif($order->order_status=='delivered')
                                                    <span class="badge badge-success" style="background: #1c84c6;">{{ucfirst($order->order_status)}}</span>
                                                    @elseif($order->order_status=='cancelled')
                                                    <span class="badge badge-success" style="background: #f44336;">{{ucfirst($order->order_status)}}</span>
                                                    @elseif($order->order_status=='temp')
                                                    <span class="badge badge-success" style="background: #f44336;">{{ucfirst('Incomplete')}}</span>
                                                    @else
                                                    <span class="badge badge-success" style="background: #ff9800;">{{ucfirst($order->order_status)}}</span>
                                                    @endif @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Date:</th>
                                                <td>{{$order->created_at->format('d-m-Y')}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Items:</th>
                                                <td>{{$order->items->count()}} Items</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="border-bottom: 1px solid #e3ebf3;">
                        <h4 class="card-title">Orders Item</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-inline" method="post" action="{{route('admin.ordersAction',['update',$order->id])}}">
                                @csrf
                                <div class="table-responsive m-t">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 50px; width: 50px; padding: 8px 10px;">SL</th>
                                                <th style="min-width: 70px; width: 50px;">Image</th>
                                                <th style="min-width: 300px;">Items</th>
                                                <th style="min-width: 120px;">QTY/Price</th>
                                                <th style="width: 250px;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->items as $i=>$item)
                                            <tr>
                                                <td style="padding: 8px 10px;">{{ $i+1 }}</td>

                                                <td>
                                                    @if($item->product)
                                                    <img src="{{asset($item->product->image())}}" style="max-height: 40px; max-width: 100%;" />
                                                    @endif
                                                </td>

                                                <td>
                                                    <div><strong>{{ $item->product_name }}</strong></div>
                                                    <small>
                                                        ID:{{ $item->product_id }} @if($item->color) , Color: {{ $item->color }} @endif @if($item->bar_code) , BarCode: {{ $item->bar_code }} @endif @if($item->sku_code) , SKU: {{
                                                        $item->sku_code }} @endif @if($item->weight_unit && $item->weight_amount) , Weight: {{ $item->weight_amount }} {{ $item->weight_unit }} @endif @if($item->dimensions_unit &&
                                                        $item->dimensions_length || $item->dimensions_width || $item->dimensions_height ) , Dimensions($item->dimensions_unit): L-{{ $item->dimensions_length }} W-{{ $item->dimensions_width }}
                                                        H-{{ $item->dimensions_height }} @endif @if($item->size) , Size: {{ $item->size }} @endif
                                                    </small>
                                                    @if($item->returnItems->count() > 0) @if($item->return_type)
                                                    <span class="badge badge-info" style="background: #ff9800;">Return</span>
                                                    @else
                                                    <span class="badge badge-primary" style="background: #ff5722;">Cancel</span>
                                                    @endif @endif
                                                </td>
                                                <td>{{ $item->quantity }} X {{priceFormat($item->price)}}</td>
                                                <td>
                                                    {{ priceFullFormat($item->total_price) }}
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>

                                        <thead>
                                            <tr>
                                                <th colspan="4"></th>
                                                <th>
                                                    <div class="input-group input-group-sm">
                                                        <select class="form-control" name="order_status" id="order_status" style="width: 250px; border: 2px solid #009688; height: 35px;">
                                                            <option option {{ $order->order_status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                                            <option {{ $order->order_status == 'confirmed' ? 'selected' : '' }} value="confirmed">Confirmed</option>
                                                            <option {{ $order->order_status == 'shipped' ? 'selected' : '' }} value="shipped">Shipped</option>
                                                            <option {{ $order->order_status == 'delivered' ? 'selected' : '' }} value="delivered">Delivered</option>
                                                            <option {{ $order->order_status == 'cancelled' ? 'selected' : '' }} value="cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group input-group-sm" style="width: 250px; margin: 5px 0;">
                                                        @if(general()->sms_status)
                                                        <label style="cursor: pointer; padding: 0 5px;"><input type="checkbox" name="mail_sms" /> Send SMS</label>
                                                        @endif @if(general()->mail_status)
                                                        <label style="cursor: pointer; padding: 0 5px;"><input type="checkbox" name="mail_send" /> Send Mail</label>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-success" type="submit" style="width: 100%; background-color: #e91e63 !important; border-color: #e91e63;">
                                                            <i class="fa fa-check"></i>
                                                            Order Update
                                                        </button>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /table-responsive -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="border-bottom: 1px solid #e3ebf3; padding: 1rem;">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title" style="padding: 5px;">Order Payment</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="left-tools" style="text-align: right;">
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#payment" style="padding: 8px 15px; border-radius: 0;"><i class="fas fa-money"></i> payment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <h4>All Transactions:</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="min-width: 150px;">Billing By</th>
                                    <th style="min-width: 300px;">Billing Info</th>
                                    <th style="min-width: 300px;">Note</th>
                                    <th style="min-width: 150px;">Amount</th>
                                </tr>
                                @foreach($order->transactionsAll as $i=>$transaction)
                                <tr>
                                    <td>
                                        <b>TNX:</b> {{$transaction->transection_id}}<br />
                                        <b>Method:</b> {{$transaction->method?$transaction->method->name:''}}<br />

                                        <b>Date:</b> {{$transaction->created_at->format('Y-m-d h:i A')}}
                                    </td>
                                    <td>
                                        <b>Name:</b> {{$transaction->billing_name}} <br />
                                        <b>Mobile:</b> {{$transaction->billing_mobile}} <br />
                                        <b>E-mail:</b> {{$transaction->billing_email}} <br />
                                    </td>
                                    <td>
                                        <b>Type: </b>@if($transaction->type==1)
                                        <span class="badge badge-success" style="background: #00bcd4;">Recharge</span>
                                        @elseif($transaction->type==2)
                                        <span class="badge badge-success" style="background: #ff9800;">Re-fund Order</span>
                                        @else
                                        <span class="badge badge-success" style="background: #8bc34a;">Order Payment</span>
                                        @endif <br />
                                        <b>Address:</b> {{$transaction->billing_address}}<br />
                                        <b>Note:</b> {{$transaction->billing_note}}
                                    </td>
                                    <td>
                                        {{$transaction->currency}} {{number_format($transaction->amount,2)}}
                                        <br />
                                        <b>Status:</b> {{ucfirst($transaction->status)}}
                                    </td>
                                </tr>
                                @endforeach @if($order->transactionsAll->count()==0)
                                <tr>
                                    <td colspan="4" style="text-align: center;">
                                        <span>No Transaction</span>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade text-left" id="payment">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times; </span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist" style="border-bottom: none;">
                    <li class="nav-item">
                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" role="tab" aria-selected="true"> Received Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" role="tab" aria-selected="false"> Refund Payment</a>
                    </li>
                </ul>
                <div class="tab-content px-1 pt-1" style="border: 1px solid #ddd;">
                    <div class="tab-pane active" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                        <form action="{{route('admin.ordersAction',['payment',$order->id])}}" method="post">
                            @csrf
                            <input type="hidden" value="0" name="transaction_type" />
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control PayAmount" step="any" name="amount" placeholder="Enter Amount" value="{{$order->due_amount?:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Method</label>
                                <div class="input-group">
                                    <select class="form-control" name="method" required="">
                                        <option value="">Select Method</option>
                                        @foreach($methods as $method)
                                        <option value="{{$method->id}}">{{$method->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="note" class="form-control" placeholder="Write Note.."></textarea>
                            </div>
                            <div class="input-group input-group-sm" style="width: 250px; margin: 5px 0;">
                                @if(general()->sms_status)
                                <label style="cursor: pointer; padding: 0 5px;"><input type="checkbox" name="mail_sms" /> Send SMS</label>
                                @endif @if(general()->mail_status)
                                <label style="cursor: pointer; padding: 0 5px;"><input type="checkbox" name="mail_send" /> Send Mail</label>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <br />
                        </form>
                    </div>
                    <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab2">
                        <form action="{{route('admin.ordersAction',['payment',$order->id])}}" method="post">
                            @csrf
                            <input type="hidden" value="1" name="transaction_type" />
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control PayAmount" name="amount" placeholder="Enter Amount" value="{{$order->paid_amount}}" />
                            </div>
                            <div class="form-group">
                                <label>Method</label>
                                <div class="input-group">
                                    <select class="form-control" name="method" required="">
                                        <option value="">Select Method</option>
                                        @foreach($methods as $method)
                                        <option value="{{$method->id}}">{{$method->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="note" class="form-control" placeholder="Write Note.."></textarea>
                            </div>
                            <div class="input-group input-group-sm" style="width: 250px; margin: 5px 0;">
                                @if(general()->sms_status)
                                <label style="cursor: pointer; padding: 0 5px;"><input type="checkbox" name="mail_sms" /> Send SMS</label>
                                @endif @if(general()->mail_status)
                                <label style="cursor: pointer; padding: 0 5px;"><input type="checkbox" name="mail_send" /> Send Mail</label>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <br />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @push('js')

<script>
    $(document).ready(function () {
        $(".paymentType").click(function () {
            var amount = $(this).data("amount");

            if (amount == 0) {
                amount = "";
            }

            $(".PayAmount").val(amount);
        });
    });
</script>

@endpush