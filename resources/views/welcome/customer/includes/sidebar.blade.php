<style>
    /* ===== Customer account — sidebar + layout ===== */
    .tab.tab-vertical { display: flex; flex-wrap: wrap; gap: 26px; align-items: flex-start; }
    .tab.tab-vertical > .customer-sidebar-col { width: 290px; flex-shrink: 0; }
    .tab.tab-vertical > .tab-content { flex: 1 1 0; min-width: 0; border: none !important; padding-top: 0 !important; }
    @media (max-width: 991.98px) { .tab.tab-vertical > .customer-sidebar-col { width: 100%; } }

    .acc-sidebar {
        background: #fff; border: 1px solid #ece7f0; border-radius: 16px;
        overflow: hidden; box-shadow: 0 6px 22px rgba(0,0,0,.05);
        margin-bottom: 22px;
    }
    .acc-sidebar .acc-user {
        display: flex; align-items: center; gap: 12px;
        padding: 20px 18px;
        background: linear-gradient(135deg, #6d1b7b, #8a2e97); color: #fff;
    }
    .acc-sidebar .acc-avatar {
        width: 46px; height: 46px; border-radius: 50%; flex-shrink: 0;
        background: rgba(255,255,255,.18);
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; font-weight: 700; text-transform: uppercase; overflow: hidden;
    }
    .acc-sidebar .acc-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .acc-sidebar .acc-meta { min-width: 0; }
    .acc-sidebar .acc-meta strong { display: block; font-size: 14.5px; font-weight: 700; line-height: 1.35; }
    .acc-sidebar .acc-meta span { font-size: 11.5px; opacity: .8; word-break: break-all; }

    .acc-sidebar .acc-nav { list-style: none; margin: 0; padding: 8px; }
    .acc-sidebar .acc-nav li { margin: 0; border: none; padding: 0; }
    .acc-sidebar .acc-nav li a {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 14px; margin: 0; border-radius: 10px;
        font-size: 14px; font-weight: 600; color: #4a4353;
        background: transparent; text-decoration: none;
        transition: background .15s ease, color .15s ease;
    }
    .acc-sidebar .acc-nav li a i { width: 18px; text-align: center; font-size: 15px; color: #9a8fa4; transition: color .15s ease; }
    .acc-sidebar .acc-nav li a:hover { background: #f5edf7; color: #6d1b7b; }
    .acc-sidebar .acc-nav li a:hover i { color: #6d1b7b; }
    .acc-sidebar .acc-nav li a.active { background: #6d1b7b; color: #fff; }
    .acc-sidebar .acc-nav li a.active i { color: #fff; }
    .acc-sidebar .acc-nav li.acc-sep { height: 1px; background: #efe9f2; margin: 6px 12px; }
    .acc-sidebar .acc-nav li a.acc-logout { color: #c0392b; }
    .acc-sidebar .acc-nav li a.acc-logout:hover { background: #fdecea; color: #c0392b; }
    .acc-sidebar .acc-nav li a.acc-logout i { color: #c0392b; }

    /* ===== Shared: header + content panels for every customer page ===== */
    .ac-header {
        padding: 50px 0; text-align: center;
        background: linear-gradient(135deg, #340f3a 0%, #55155f 100%);
    }
    .ac-header h1 { color: #fff; font-size: 30px; font-weight: 800; margin: 0 0 8px; }
    .ac-header .ac-crumb { font-size: 13px; color: rgba(255,255,255,.75); }
    .ac-header .ac-crumb a { color: rgba(255,255,255,.75); text-decoration: none; }
    .ac-header .ac-crumb a:hover { color: #fff; }
    .ac-header .ac-crumb .sep { opacity: .5; margin: 0 2px; }
    @media (max-width: 767.98px) { .ac-header { padding: 34px 0; } .ac-header h1 { font-size: 23px; } }

    /* page background wrappers used by the various customer pages */
    .account-page, .userdashboard, .customer-wrap { background: #faf8fb; padding: 36px 0 60px; }
    .userdashboard .row { margin: 0; }

    /* content panel — normalise every content container into one clean card */
    .tab.tab-vertical > .tab-content,
    .userdashboard .usermainbody,
    .customer-panel {
        background: #fff !important; border: 1px solid #ece7f0; border-radius: 16px;
        box-shadow: 0 6px 22px rgba(0,0,0,.05);
        padding: 26px !important; margin: 0 !important;
    }
    .userdashboard .usercontent, .userdashboard .myrecentorder { min-height: 0 !important; }

    /* panel title */
    .customer-panel-title,
    .userdashboard .myrecentorder > p:first-child,
    .dashboard_content .card-header h3 {
        font-size: 17px !important; font-weight: 800 !important; color: #2b2333 !important;
        margin: 0 0 18px !important; padding: 0 0 12px !important;
        border: none !important; border-bottom: 1px solid #ece7f0 !important;
    }
    .dashboard_content .card { border: none; }
    .dashboard_content .card-header { background: none; border: none; padding: 0; }
    .dashboard_content .card-body { padding: 0; }

    /* tables */
    .tab.tab-vertical .tab-content table,
    .userdashboard .usermainbody table,
    .customer-panel table {
        width: 100%; border-collapse: separate; border-spacing: 0;
        font-size: 13.5px; margin: 0; background: transparent !important;
    }
    .tab.tab-vertical .tab-content table th,
    .userdashboard .usermainbody table th,
    .customer-panel table th {
        background: #f6eef8 !important; color: #2b2333 !important; font-weight: 700 !important;
        padding: 11px 12px !important; border: none !important;
        border-bottom: 2px solid #e8d9ec !important;
        text-align: left; font-size: 12px !important; text-transform: uppercase; letter-spacing: .03em;
        width: auto !important; min-width: 0 !important;
    }
    .tab.tab-vertical .tab-content table td,
    .userdashboard .usermainbody table td,
    .customer-panel table td {
        padding: 11px 12px !important; border: none !important;
        border-bottom: 1px solid #f0ebf3 !important;
        background: #fff !important; color: #4a4353; vertical-align: middle;
    }
    .tab.tab-vertical .tab-content table tbody tr:hover td,
    .customer-panel table tbody tr:hover td { background: #faf6fb !important; }

    /* status pill */
    .order-status, .oc-status {
        display: inline-block; padding: 4px 12px; border-radius: 999px;
        font-size: 11.5px; font-weight: 700; text-transform: capitalize;
        background: #f0e7f3; color: #6d1b7b;
    }

    /* forms */
    .tab.tab-vertical .tab-content label,
    .userdashboard .usermainbody label,
    .customer-panel label,
    .dashboard_content label {
        font-size: 12.5px !important; font-weight: 700 !important; color: #2b2333 !important;
        margin-bottom: 7px; display: inline-block;
    }
    .tab.tab-vertical .tab-content .form-control,
    .userdashboard .usermainbody .form-control,
    .customer-panel .form-control,
    .dashboard_content .form-control {
        border: 1px solid #ddd3e3 !important; border-radius: 10px !important;
        padding: 11px 14px !important; font-size: 14px !important;
        background: #fdfcfe !important; box-shadow: none !important; height: auto !important;
        color: #2b2333 !important; width: 100%;
    }
    .tab.tab-vertical .tab-content .form-control:focus,
    .userdashboard .usermainbody .form-control:focus,
    .customer-panel .form-control:focus,
    .dashboard_content .form-control:focus {
        border-color: #6d1b7b !important; background: #fff !important;
        box-shadow: 0 0 0 3px rgba(109,27,123,.12) !important;
    }

    /* primary buttons */
    .tab.tab-vertical .tab-content .btn-primary,
    .userdashboard .usermainbody .btn-primary,
    .customer-panel .btn-primary,
    .dashboard_content .btn-primary {
        background: #6d1b7b !important; border: none !important; color: #fff !important;
        border-radius: 10px !important; padding: 11px 26px !important;
        font-size: 14px !important; font-weight: 700 !important;
        box-shadow: 0 6px 16px rgba(109,27,123,.22) !important;
    }
    .tab.tab-vertical .tab-content .btn-primary:hover,
    .userdashboard .usermainbody .btn-primary:hover,
    .customer-panel .btn-primary:hover,
    .dashboard_content .btn-primary:hover { background: #591562 !important; }

    /* small action / view buttons inside order tables */
    .tab.tab-vertical .tab-content a.btn,
    .userdashboard .usermainbody a.btn.btn-sm,
    .customer-panel a.btn.btn-sm {
        background: #6d1b7b !important; color: #fff !important; border: none !important;
        border-radius: 8px !important; padding: 7px 16px !important;
        font-size: 12.5px !important; font-weight: 600 !important; box-shadow: none !important;
    }
    .tab.tab-vertical .tab-content a.btn.btn-dark span { background: transparent !important; color: #fff !important; }

    /* pagination */
    .tab.tab-vertical .tab-content ul.pager,
    .userdashboard .usermainbody ul.pager,
    .customer-panel ul.pager {
        background: transparent !important; text-align: center; padding: 16px 0 0 !important; margin: 8px 0 0 !important;
    }
    .tab.tab-vertical .tab-content ul.pager li,
    .userdashboard .usermainbody ul.pager li { display: inline-block; }
    .tab.tab-vertical .tab-content ul.pager li a,
    .userdashboard .usermainbody ul.pager li a {
        display: inline-block; padding: 6px 12px; margin: 0 3px; border-radius: 8px;
        background: #f5edf7; color: #6d1b7b; text-decoration: none; font-size: 13px;
    }
</style>

<div class="customer-sidebar-col">
    <div class="acc-sidebar">
        <div class="acc-user">
            <span class="acc-avatar">
                @php $u = Auth::user(); $img = method_exists($u,'image') ? $u->image() : null; @endphp
                @if($img && !\Illuminate\Support\Str::contains($img, 'noimage'))
                    <img src="{{ asset($img) }}" alt="{{ $u->name }}">
                @else
                    {{ mb_substr($u->name, 0, 1) }}
                @endif
            </span>
            <span class="acc-meta">
                <strong>{{ $u->name }}</strong>
                <span>{{ $u->email }}</span>
            </span>
        </div>

        <ul class="acc-nav">
            @if(Auth::user()->admin)
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge-high"></i> Admin Dashboard</a></li>
                <li class="acc-sep"></li>
            @endif
            <li><a href="{{ route('customer.dashboard') }}" class="{{ Request::is('customer/dashboard') ? 'active' : '' }}"><i class="fa-solid fa-table-columns"></i> Dashboard</a></li>
            <li><a href="{{ route('customer.myOrders') }}" class="{{ (Request::is('customer/orders*') || Request::is('customer/return-cancellations-orders')) ? 'active' : '' }}"><i class="fa-solid fa-box"></i> Orders</a></li>
            <li><a href="{{ route('customer.profile') }}" class="{{ (Request::is('customer/profile*') || Request::is('customer/change-password')) ? 'active' : '' }}"><i class="fa-solid fa-user"></i> Account Details</a></li>
            <li><a href="{{ route('customer.myReviews') }}" class="{{ Request::is('customer/my-reviews') ? 'active' : '' }}"><i class="fa-solid fa-star"></i> My Reviews</a></li>
            <li><a href="{{ route('myWishlist') }}" class="{{ Request::is('my-wishlist') ? 'active' : '' }}"><i class="fa-solid fa-heart"></i> Wishlist</a></li>
            <li class="acc-sep"></li>
            <li>
                <a href="javascript:void(0)" class="acc-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
            </li>
        </ul>
    </div>
</div>
