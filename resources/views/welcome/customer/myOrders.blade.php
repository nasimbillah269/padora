@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('My Orders')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('My Orders')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.myOrders')}}" />
<link rel="canonical" href="{{route('customer.myOrders')}}">
@endsection 
@push('css')
@endpush
@section('contents')

@include(welcomeTheme().'.customer.includes.pageHeader', ['pageTitle' => 'My Orders'])

<div class="userdashboard">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">
            @include(welcomeTheme().'.customer.includes.sidebar')
            <div class="tab-content">
                <p class="customer-panel-title">My Orders</p>
                <div class="table-responsive">
                    <table class="shop-table account-orders-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $i=>$order)
                            <tr>
                                <td><strong>#{{$order->invoice}}</strong></td>
                                <td>{{$order->created_at->format('M d, Y')}}</td>
                                <td><span class="order-status">{{$order->order_status}}</span></td>
                                <td>{{ priceFullFormat($order->grand_total) }} <span class="text-muted">· {{$order->items->count()}} item(s)</span></td>
                                <td>
                                    <a href="{{ route('customer.orderDetails',$order->invoice) }}" class="btn btn-sm">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align:center; padding:30px 0; color:#8a8194;">You have no orders yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $orders->links('pagination') }}
                <div style="margin-top:18px;">
                    <a href="{{route('index')}}" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush