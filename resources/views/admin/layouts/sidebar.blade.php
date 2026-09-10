<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header"><span>General </span><i class="feather icon-minus"></i></li>
            <li class=" nav-item {{Request::is('admin/dashboard')? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}"><i class="fas fa-th-large"></i><span class="menu-title" data-i18n="Email Application">Dashboard</span></a>
            </li>
            <li class=" nav-item {{Request::is('admin/my-profile')? 'active' : ''}}">
                <a href="{{route('admin.myProfile')}}"><i class="fas fa-user-check"></i><span class="menu-title">My Profile</span></a>
            </li>
            <!--Permission Check List Menus Start-->
            @if($roles = Auth::user()->permission) @if( isset(json_decode($roles->permission, true)['posts']['list']) || isset(json_decode($roles->permission, true)['postsOther']['list']) )
            <li class="nav-item {{Request::is('admin/posts*')? 'active' : ''}}">
                <a href="index.html">
                    <i class="fas fa-file-alt"></i>
                    <span class="menu-title" data-i18n="Dashboard">Posts </span>
                    <!-- <span class="badge badge badge-primary badge-pill float-right mr-2">3 </span> -->
                </a>
                <ul class="menu-content">
                    @isset(json_decode($roles->permission, true)['posts']['list'])
                    <li
                        class="
             @if( Request::is('admin/posts/categories*') || Request::is('admin/posts/tags*') || Request::is('admin/posts/comments*') )
             @else
             {{Request::is('admin/posts*')? 'active' : ''}}
             @endif
             "
                    >
                        <a class="menu-item" href="{{route('admin.posts')}}">All Posts </a>
                    </li>
                    @endisset @isset(json_decode($roles->permission, true)['posts']['add'])
                    <li><a class="menu-item" href="{{route('admin.postsAction',['create'])}}">New Post </a></li>
                    @endisset @isset(json_decode($roles->permission, true)['postsOther']['category'])
                    <li class="{{Request::is('admin/posts/categories*')? 'active' : ''}}">
                        <a class="menu-item" href="{{route('admin.postsCategories')}}">Categories </a>
                    </li>
                    @endisset {{--@isset(json_decode($roles->permission, true)['postsOther']['tags'])
                    <li class="{{Request::is('admin/posts/tags*')? 'active' : ''}}">
                        <a class="menu-item" href="{{route('admin.postsTags')}}">Tags </a>
                    </li>
                    @endisset @isset(json_decode($roles->permission, true)['postsOther']['comments'])
                    <li class="{{Request::is('admin/posts/comments*')? 'active' : ''}}">
                        <a class="menu-item" href="{{route('admin.postsCommentsAll')}}">Comments </a>
                    </li>
                    @endisset--}}
                </ul>
            </li>
            @endif @isset(json_decode($roles->permission, true)['pages']['list'])
            <li class="nav-item {{Request::is('admin/pages*')? 'active' : ''}}">
                <a href="{{route('admin.pages')}}"><i class="fas fa-copy"></i><span class="menu-title">Pages</span></a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['medies']['list'])
            <li class="nav-item {{Request::is('admin/medies*')? 'active' : ''}}">
                <a href="{{route('admin.medies')}}"><i class="fas fa-images"></i><span class="menu-title">Medias Library</span></a>
            </li>
            @endisset

            <li class="navigation-header">
                <span>Products Unit </span><i class="feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Others"></i>

                @if( isset(json_decode($roles->permission, true)['ecommerceSetting']['general']) || isset(json_decode($roles->permission, true)['ecommerceSetting']['coupons']) )
            </li>

            <li class="nav-item {{Request::is('admin/ecommerce*')? 'active' : ''}}">
                <a href="#"> <i class="fa-solid fa-sliders"></i> <span class="menu-title">Ecommerce Setting </span></a>
                <ul class="menu-content">
                    @isset(json_decode($roles->permission, true)['ecommerceSetting']['general'])
                    <li class="{{Request::is('admin/ecommerce/setting*')? 'active' : ''}}">
                        <a class="menu-item" href="{{route('admin.ecommerceSetting','general')}}">General Setting</a> @endisset @isset(json_decode($roles->permission, true)['ecommerceSetting']['coupons'])
                    </li>

                    <li class="{{Request::is('admin/ecommerce/coupons*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.ecommerceCoupons')}}">Coupons</a></li>
                    @endisset
                </ul>
            </li>
            @endif @if( isset(json_decode($roles->permission, true)['products']['list']) || isset(json_decode($roles->permission, true)['productsCtg']['list']) )
            <li class="nav-item">
                <a href="#"><i class="fas fa-stream"></i><span class="menu-title">Products </span></a>
                <ul class="menu-content">
                    @isset(json_decode($roles->permission, true)['products']['list'])
                    <li
                        class="
             @if( Request::is('admin/products/categories*'))
             @else
             {{Request::is('admin/products*')? 'active' : ''}}
             @endif
             "
                    >
                        <a class="menu-item" href="{{route('admin.products')}}">All Products</a>
                    </li>
                    @endisset @isset(json_decode($roles->permission, true)['productsOther']['category'])
                    <li class="{{Request::is('admin/products/categories*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.productsCategories')}}">Categories</a></li>
                    @endisset 
                    @isset(json_decode($roles->permission, true)['productsOther']['tag'])
                    <li class="{{Request::is('admin/products/tags*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.productsTags')}}">Tags</a></li>
                    @endisset @isset(json_decode($roles->permission, true)['productsOther']['attribute'])
                    <li class="{{Request::is('admin/products/attributes*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.productsAttributes')}}">Attributes</a></li>
                    @endisset
                </ul>
            </li>
            @endif

            <li class="nav-item {{Request::is('admin/orders*')? 'active' : ''}}">
                <a href="#"><i class="fas fa-sitemap"></i><span class="menu-title">Order Management</span></a>
                <ul class="menu-content">
                    <li class="{{Request::is('admin/orders')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders')}}"> Order List</a></li>
                    <li class="{{Request::is('admin/orders/pending')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','pending')}}"> Pending Order</a></li>
                    <li class="{{Request::is('admin/orders/confirmed')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','confirmed')}}"> Confirmed Orders</a></li>
                    <li class="{{Request::is('admin/orders/shipped')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','shipped')}}"> Shipped Orders</a></li>
                    <li class="{{Request::is('admin/orders/delivered')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','delivered')}}"> Delivered Orders</a></li>
                    <li class="{{Request::is('admin/orders/cancelled')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','cancelled')}}"> Cancelled Orders</a></li>
                    <li class="{{Request::is('admin/orders/unpaid')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','unpaid')}}"> Unpaid Orders</a></li>
                    <li class="{{Request::is('admin/orders/pending-payment')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','pending-payment')}}"> Pending Payment</a></li>
                    <li class="{{Request::is('admin/orders/incomplete')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.orders','incomplete')}}"> Incomplete Orders</a></li>
                </ul>
            </li>
            <li class="navigation-header"><span style="color: #009688; font-weight: bold;">Report Unit </span><i class="feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Others"></i></li>
            {{--<li class="nav-item {{Request::is('admin/reports*')? 'active' : ''}}">
                <a href="#"><i class="fas fa-chart-line"></i><span class="menu-title"> Reports Management</span></a>
                <ul class="menu-content">
                    <li class="{{Request::is('admin/reports/summery*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.reportsAll','summery')}}"> Summery Reports</a></li>
                    <li class="{{Request::is('admin/reports/products*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.reportsAll','products')}}"> Products Reports</a></li>
                    <li class="{{Request::is('admin/reports/customer-reports*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.reportsAll','customer-reports')}}"> Customer Reports</a></li>
                    <li class="{{Request::is('admin/reports/order-reports*')? 'active' : ''}}"><a class="menu-item" href="{{route('admin.reportsAll','order-reports')}}"> Order Reports</a></li>
                </ul>
            </li>--}}

            @if( isset(json_decode($roles->permission, true)['clients']['list']) || isset(json_decode($roles->permission, true)['brands']['list']) || isset(json_decode($roles->permission, true)['sliders']['list']) ||
            isset(json_decode($roles->permission, true)['galleries']['list']) || isset(json_decode($roles->permission, true)['menus']['list']) || isset(json_decode($roles->permission, true)['themeSetting']['list']) )

            <li class="navigation-header"><span style="color: #009688; font-weight: bold;">General Unit </span><i class="feather icon-minus"></i></li>

            @isset(json_decode($roles->permission, true)['clients']['list'])
            <li class=" nav-item {{Request::is('admin/clients*')? 'active' : ''}}">
                <a href="{{route('admin.clients')}}"><i class="fas fa-user-tie"></i><span class="menu-title">Suppliers</span></a>
            </li>
            @endisset {{--@isset(json_decode($roles->permission, true)['brands']['list'])
            <li class=" nav-item {{Request::is('admin/brands*')? 'active' : ''}}">
                <a href="{{route('admin.brands')}}"><i class="fas fa-chess-rook"></i><span class="menu-title">Brands</span></a>
            </li>
            @endisset--}} @isset(json_decode($roles->permission, true)['sliders']['list'])
            <li class=" nav-item {{Request::is('admin/sliders*')? 'active' : ''}}">
                <a href="{{route('admin.sliders')}}"><i class="fas fa-chalkboard"></i><span class="menu-title">Sliders</span></a>
            </li>
            @endisset {{--@isset(json_decode($roles->permission, true)['galleries']['list'])
            <li class=" nav-item {{Request::is('admin/galleries*')? 'active' : ''}}">
                <a href="{{route('admin.galleries')}}"><i class="fas fa-images"></i><span class="menu-title">Galleries</span></a>
            </li>
            @endisset--}} @isset(json_decode($roles->permission, true)['menus']['list'])
            <li class=" nav-item {{Request::is('admin/menus*')? 'active' : ''}}">
                <a href="{{route('admin.menus')}}"><i class="fas fa-bars"></i><span class="menu-title">Menus Setting</span></a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['themeSetting']['list'])
            <li class=" nav-item {{Request::is('admin/theme-setting*')? 'active' : ''}}">
                <a href="{{route('admin.themeSetting')}}"><i class="fa-solid fa-sliders"></i><span class="menu-title">Theme Setting</span></a>
            </li>
            @endisset @endif @if( isset(json_decode($roles->permission, true)['adminUsers']['list']) || isset(json_decode($roles->permission, true)['adminRoles']['list']) || isset(json_decode($roles->permission, true)['users']['list']) ||
            isset(json_decode($roles->permission, true)['subscribe']['list']) )

            <li class="navigation-header">
                <span style="color: #00bcd4; font-weight: bold;">Users Management </span><i class="feather icon-droplet feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="UI"></i>
            </li>
            @isset(json_decode($roles->permission, true)['adminUsers']['list'])
            <li class=" nav-item {{Request::is('admin/users/admin*')? 'active' : ''}}">
                <a href="{{route('admin.usersAdmin')}}"><i class="fas fa-user"></i><span class="menu-title">Administrator Users </span></a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['adminRoles']['list'])
            <li class=" nav-item {{Request::is('admin/users/role*')? 'active' : ''}}">
                <a href="{{route('admin.userRoles')}}"><i class="fas fa-ruler-combined"></i><span class="menu-title">Roles Users </span></a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['users']['list'])
            <li class=" nav-item {{Request::is('admin/users/customer*')? 'active' : ''}}">
                <a href="{{route('admin.usersCustomer')}}"><i class="fas fa-users"></i><span class="menu-title">Customer Users </span></a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['subscribe']['list'])
            <li class=" nav-item {{Request::is('admin/subscribes*')? 'active' : ''}}">
                <a href="{{route('admin.subscribes')}}"><i class="fas fa-user-tag"></i><span class="menu-title">Subscribe Users </span></a>
            </li>
            @endisset @endif @if( isset(json_decode($roles->permission, true)['appsSetting']['general']) || isset(json_decode($roles->permission, true)['appsSetting']['mail']) || isset(json_decode($roles->permission,
            true)['appsSetting']['sms']) || isset(json_decode($roles->permission, true)['appsSetting']['social']) )
            <li class="navigation-header"><span style="color: #000000; font-weight: bold;">Apps Setting </span><i class="feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Others"></i></li>
            @endif @isset(json_decode($roles->permission, true)['appsSetting']['general'])
            <li class="nav-item {{Request::is('admin/setting/general*')? 'active' : ''}}">
                <a href="{{route('admin.setting','general')}}">
                    <i class="fa fa-cog"></i>
                    <span class="menu-title">General Setting</span>
                </a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['appsSetting']['mail'])
            <li class=" nav-item {{Request::is('admin/setting/mail*')? 'active' : ''}}">
                <a href="{{route('admin.setting','mail')}}">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-title">Mail Setting</span>
                </a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['appsSetting']['sms'])
            <li class=" nav-item {{Request::is('admin/setting/sms*')? 'active' : ''}}">
                <a href="{{route('admin.setting','sms')}}">
                    <i class="fas fa-comments"></i>
                    <span class="menu-title">SMS Setting</span>
                </a>
            </li>
            @endisset @isset(json_decode($roles->permission, true)['appsSetting']['social'])
            <li class=" nav-item {{Request::is('admin/setting/social*')? 'active' : ''}}">
                <a href="{{route('admin.setting','social')}}">
                    <i class="fab fa-codepen"></i>
                    <span class="menu-title">Social Setting</span>
                </a>
            </li>
            @endisset @endif

            <!--Permission Check List Menus End-->
        </ul>
        <div style="padding: 15px; text-align: center; border: 1px solid #e5e7ec; font-size: 20px;">
            <p>
                Support Center<br />
                Contact Us<br />
                Call: {{general()->mobile}}
            </p>
        </div>
    </div>
</div>
<!-- END: Main Menu-->