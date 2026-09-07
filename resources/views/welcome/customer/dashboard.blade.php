@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle('Dashboard')}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle('Dashboard')}}" />
<meta name="description" property="og:description" content="{!!general()->meta_description!!}" />
<meta name="keywords" content="{{general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset(general()->logo())}}" />
<meta name="url" property="og:url" content="{{route('customer.dashboard')}}" />
<link rel="canonical" href="{{route('customer.dashboard')}}">
@endsection
@push('css')
<style>
    :root { --ac-accent: #6d1b7b; --ac-ink: #2b2333; --ac-muted: #6f6779; --ac-line: #ece7f0; }

    .ac-welcome {
        background: #fff; border: 1px solid var(--ac-line); border-radius: 16px;
        padding: 22px 24px; margin-bottom: 22px; box-shadow: 0 6px 22px rgba(0,0,0,.05);
    }
    .ac-welcome h4 { font-size: 17px; font-weight: 800; color: var(--ac-ink); margin: 0 0 4px; }
    .ac-welcome p { font-size: 13.5px; color: var(--ac-muted); margin: 0; }
    .ac-welcome p a { color: var(--ac-accent); font-weight: 600; }

    .ac-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .ac-card {
        display: flex; flex-direction: column; align-items: center; text-align: center;
        background: #fff; border: 1px solid var(--ac-line); border-radius: 16px;
        padding: 30px 20px; text-decoration: none;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }
    .ac-card:hover { transform: translateY(-5px); box-shadow: 0 16px 34px rgba(109,27,123,.12); border-color: #e3d3e8; }
    .ac-card .ac-ic {
        width: 60px; height: 60px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: #f3e9f6; color: var(--ac-accent); font-size: 24px; margin-bottom: 14px;
    }
    .ac-card h5 { font-size: 15px; font-weight: 700; color: var(--ac-ink); margin: 0 0 4px; text-transform: uppercase; letter-spacing: .03em; }
    .ac-card span { font-size: 12.5px; color: var(--ac-muted); }
    .ac-card .ac-count { font-size: 22px; font-weight: 800; color: var(--ac-accent); line-height: 1; margin-bottom: 4px; }

    @media (max-width: 767.98px) {
        .ac-cards { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('contents')

@include(welcomeTheme().'.customer.includes.pageHeader', ['pageTitle' => 'My Account'])

<div class="account-page">
    <div class="container">
        <div class="tab tab-vertical row gutter-lg">
            @include(welcomeTheme().'.customer.includes.sidebar')

            <div class="tab-content">
                @php
                    $ordersCount = \App\Models\Order::where('user_id', $user->id)->where('order_type','customer_order')->count();
                @endphp

                <div class="ac-welcome">
                    <h4>Hello, {{ $user->name }} 👋</h4>
                    <p>
                        From your dashboard you can view your recent orders, manage your account details and track your wishlist.
                        Not you? <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                    </p>
                </div>

                <div class="ac-cards">
                    <a href="{{ route('customer.myOrders') }}" class="ac-card">
                        <div class="ac-ic"><i class="fa-solid fa-box"></i></div>
                        <div class="ac-count">{{ $ordersCount }}</div>
                        <h5>Orders</h5>
                        <span>View & track your orders</span>
                    </a>
                    <a href="{{ route('customer.profile') }}" class="ac-card">
                        <div class="ac-ic"><i class="fa-solid fa-user-gear"></i></div>
                        <h5>Account Details</h5>
                        <span>Update your profile & password</span>
                    </a>
                    <a href="{{ route('myWishlist') }}" class="ac-card">
                        <div class="ac-ic"><i class="fa-solid fa-heart"></i></div>
                        <h5>Wishlist</h5>
                        <span>Products you saved for later</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @push('js') @endpush
