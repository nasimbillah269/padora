@extends(welcomeTheme().'layouts.app')
@section('title')
<title>{{ websiteTitle('Returns & Cancellations') }}</title>
@endsection
@section('SEO')
<meta name="description" content="{!! general()->meta_description !!}">
<meta name="keywords" content="{{ general()->meta_keyword }}">
@endsection
@push('css') @endpush

@section('contents')

@include(welcomeTheme().'.customer.includes.pageHeader', ['pageTitle' => 'Returns & Cancellations'])

<div class="userdashboard">
    <div class="container">
        <div class="row" style="margin:0;">
            <div class="col-lg-3 usersidebardiv" style="padding:0;">
                @include(welcomeTheme().'.customer.includes.sidebar')
            </div>
            <div class="col-lg-9 usermainbody">
                <p class="customer-panel-title">Returns &amp; Cancellations</p>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product</th>
                                <th>Invoice</th>
                                <th>Qty</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orderItems as $i => $item)
                            <tr>
                                <td>{{ $orderItems->firstItem() + $i }}</td>
                                <td>
                                    @if($item->product)
                                        <a href="{{ route('productView', $item->product->slug ?: \Illuminate\Support\Str::slug($item->product->name)) }}">{{ \Illuminate\Support\Str::limit($item->product->name, 40) }}</a>
                                    @else
                                        {{ $item->product_name ?? '—' }}
                                    @endif
                                </td>
                                <td>{{ $item->invoice ?? '—' }}</td>
                                <td>{{ $item->quantity ?? '—' }}</td>
                                <td><span class="order-status">{{ $item->status ?? $item->order_status ?? 'requested' }}</span></td>
                                <td>{{ optional($item->created_at)->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="6" style="text-align:center; padding:30px 0; color:#8a8194;">No return or cancellation requests found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $orderItems->links('pagination') }}
            </div>
        </div>
    </div>
</div>

@endsection
@push('js') @endpush
