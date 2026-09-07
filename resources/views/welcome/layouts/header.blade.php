@if(general()->copyright_text)
<div class="headLine">
    <marquee>
        <span class="headLineText">
          {!!general()->copyright_text!!}
        </span>
     </marquee>
</div>
@endif

<style>
/* ===== Mobile side menu (professional) ===== */
.mobile-menu-side-modals2.side-modals.right { width: 320px; right: -340px; }
.mobile-menu-side-modals2.side-modals.right.open-side { right: 0; }
.mobile-menu-side-modals2 .pmMenuArea { height: 100%; }
.mobile-menu-side-modals2 .cart-inner { background: #ffffff; height: 100%; display: flex; flex-direction: column; }

.pm-menu-head {
    display: flex; align-items: center; justify-content: space-between;
    padding: 15px 18px; background: #faf6fb;
    border-bottom: 1px solid #efe7f2;
}
.pm-menu-head img { max-height: 38px; width: auto; display: block; }
.pm-menu-close {
    width: 34px; height: 34px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%; background: #fff;
    border: 1px solid #e7ddec; color: #6d1b7b;
    transition: background .15s ease, color .15s ease;
}
.pm-menu-close:hover { background: #6d1b7b; color: #fff; border-color: #6d1b7b; }
.pm-menu-close svg { width: 13px; height: 13px; }

.pm-menu-body { padding: 10px 0 24px; overflow-y: auto; flex: 1; }

.mobile-menu-side-modals2 ul.mobileCate { background: transparent; padding: 6px 12px; margin: 0; }
.mobile-menu-side-modals2 ul.mobileCate > li {
    border: none; border-bottom: 1px solid #f2ecf5; margin: 0;
}
.mobile-menu-side-modals2 ul.mobileCate > li:last-child { border-bottom: none; }
.mobile-menu-side-modals2 ul.mobileCate li a {
    font-size: 15px; font-weight: 600; color: #2c2433;
    display: flex; align-items: center; gap: 11px;
    padding: 13px 10px; border-radius: 10px;
    transition: background .15s ease, color .15s ease;
}
.mobile-menu-side-modals2 ul.mobileCate li a:hover,
.mobile-menu-side-modals2 ul.mobileCate li a:active { background: #f4ecf7; color: #6d1b7b; }
.mobile-menu-side-modals2 ul.mobileCate li a::before {
    content: ""; width: 6px; height: 6px; border-radius: 50%;
    background: #d9c7e0; flex-shrink: 0; transition: background .15s ease;
}
.mobile-menu-side-modals2 ul.mobileCate li a:hover::before { background: #6d1b7b; }

.mobile-menu-side-modals2 .downMenus {
    display: flex; align-items: center; justify-content: space-between; border-radius: 10px;
}
.mobile-menu-side-modals2 .downMenus > a { flex: 1; }
.mobile-menu-side-modals2 .downMenus i {
    width: 40px; height: 44px; display: flex; align-items: center; justify-content: center;
    color: #9c8fa4; font-size: 14px;
    transform: rotate(-90deg); transition: transform .25s ease, color .15s ease;
}
.mobile-menu-side-modals2 .downMenus.active i { transform: rotate(0deg); color: #6d1b7b; }

.mobile-menu-side-modals2 ul.mobileCate li ul {
    padding-left: 14px !important; margin: 0 0 8px;
    border-left: 2px solid #eee2f2;
}
.mobile-menu-side-modals2 ul.mobileCate li ul li { border: none !important; }
.mobile-menu-side-modals2 ul.mobileCate li ul li a {
    font-size: 13.5px; font-weight: 500; color: #5b5265; padding: 10px;
}
.mobile-menu-side-modals2 ul.mobileCate li ul li a::before { width: 5px; height: 5px; }

.pm-menu-account { padding: 18px 20px 0; display: flex; flex-direction: column; gap: 10px; }
.pm-menu-account a {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    padding: 12px 16px; border-radius: 10px;
    font-size: 14px; font-weight: 700; text-decoration: none; margin: 0;
}
.pm-menu-account .pm-btn-primary { background: #6d1b7b; color: #fff; }
.pm-menu-account .pm-btn-primary:hover { background: #591562; }
.pm-menu-account .pm-btn-outline { background: #fff; color: #6d1b7b; border: 1.5px solid #6d1b7b; }
.pm-menu-account .pm-btn-outline:hover { background: #f4ecf7; }
</style>

<!-- header part start -->
<header>
    <div class="headerTopPart">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="topTex">
                        <a href="{{route('index')}}">Welcome to Pandora.</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="headerSocialLink">
                    @php
                        $general = App\Models\General::first();
                    @endphp
                    
                    <ul>
                        @if(!empty($general->facebook_link))
                        <li>
                            <a href="{{ $general->facebook_link }}" target="_blank" title="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                        </li>
                        @endif
                        
                  
                    
                        @if(!empty($general->instagram_link))
                        <li>
                            <a href="{{ $general->instagram_link }}" target="_blank" title="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        @endif
                    
                        @if(!empty($general->youtube_link))
                        <li>
                            <a href="{{ $general->youtube_link }}" target="_blank" title="YouTube"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
                        </li>
                        @endif
                    
                        @if(!empty($general->linkedin_link))
                        <li>
                            <a href="{{ $general->linkedin_link }}" target="_blank" title="LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                        </li>
                        @endif
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="headerMidPart">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="logoDiv">
                       
                        <a href="{{route('index')}}">
                            <img src="{{asset(general()->logo())}}" alt="{{general()->title}}" />
                        </a>
                        <div class="headerAccount">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="openSearch()" ><i class="fa fa-search"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="moble-menus-models" style="margin-left:10px;">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="cart-count">@isset($cartsCount){{$cartsCount}}@endisset</span>
                                    </a>
                                </li>
                                <li>
                                     <div class="openBtn mobileBar moble-menus-models2"><i class="fa fa-bars"></i></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="searchDiv">
                        <form method="get" action="{{route('search')}}">
                            <div class="input-group">
                                {{--<select class="form-select" aria-label="Default select example">
                                    <option selected>Select a category</option>
                                    @foreach(App\Models\Attribute::where('status','active')->where('parent_id',null)->where('type',0)->orderBy('name')->get(['name','slug']) as $ctg)
                                    <option value="{{$ctg->slug}}" {{request()->category==$ctg->slug?'selected':''}}>{{$ctg->name}}</option>
                                    @endforeach
                                </select>--}}
                                <input type="text" name="search" id="search" value="{{request()->search}}" aria-label="Last name" class="form-control" placeholder="Search Products..." />
                                <button class="btn" type="submit" id="button-addon2">
                                    Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                 <div class="headerAccountDiv">
                <ul>
                    <li>
                        @if(Auth::check())
                            <a href="{{ route('customer.dashboard') }}" title="Dashboard">
                                <i class="fa-regular fa-user" aria-hidden="true"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" title="Login">
                                <i class="fa-solid fa-arrow-right-to-bracket" aria-hidden="true"></i>
                            </a>
                        @endif
                    </li>
                    <li class="li">
                        <a href="{{ route('myWishlist') }}" title="Wishlist">
                            <i class="fa-regular fa-heart" aria-hidden="true"></i>
                            <span class="wishlist-count">@isset($wlCount){{ $wlCount }}@endisset</span>
                        </a>
                    </li>
                    <li class="li">
                        <a href="javascript:void(0)" class="moble-menus-models" title="Cart">
                           <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">@isset($cartsCount){{ $cartsCount }}@endisset</span> 
                        </a>
                    </li>
                </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="headerNavPart">
        <div class="container">
            <div class="row">
               <div class="col-md-3">
                    <div class="headerDropdownMenu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span>All Product Category</span>
                        <i class="fa fa-angle-down downArrow" aria-hidden="true"></i>
                        
                        <!-- category list start -->
                        <div class="categoryListMain">
                            <div class="container">
                                @if($menu = menu('Header Categories'))
                                <ul class="categroyList">
                                    @foreach($menu->subMenus as $menu)
                                    <li>
                                        <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                        <!-- category list end -->
                        
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="headerNavMenu">
                        @if($menu = menu('Header Menus'))
                        <ul>
                            <li>
                                <a href="{{route('index')}}">Home</a>
                            </li>
                            @foreach($menu->subMenus as $menu)
                            @if($menu->subMenus()->count()  > 0)
                            <li class="dropdown">
                                <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="dropdown-content">
                                    @foreach($menu->subMenus as $menu)
                                    <ul>
                                        <li>
                                            <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                                        </li>
                                    </ul>
                                    @endforeach
                                </div>
                            </li>
                            @else
                            <li>
                                <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="collUs">
                        <div>
                            <i class="fa fa-headphones" aria-hidden="true"></i>
                        </div>
                        <div>
                            <span>Call Us:</span>
                            <p><a href="tel:{{general()->mobile}}">{{general()->mobile}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="myOverlay" class="overlay">
      <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
      <div class="overlay-content">
        <div style="padding: 10px;background: white;margin: 100px 10px;">
            <div class="searchDiv1">
                <form method="get" action="{{route('search')}}">
                    <div class="input-group">
                        <input type="text" name="search" id="search" value="{{request()->search}}" aria-label="Last name" class="form-control" placeholder="Search Products..." />
                        <button class="btn" type="submit" style="background: #57a4cf;color: white;">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    
</header>
<!-- header part end -->

<div class="mobile-menu-side-modals2 side-modals right">
    <a href="javascript:void(0)" class="overlay side-modals-close"></a>
    <div class="pmMenuArea">
        <div class="cart-inner">
            <div class="pm-menu-head">
                <img src="{{asset(general()->logo())}}" alt="{{general()->title}}" />
                <a href="javascript:void(0)" class="side-modals-close pm-menu-close" aria-label="Close menu">
                    <svg viewBox="0 0 320 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path>
                    </svg>
                </a>
            </div>

            <div class="pm-menu-body">
                @if($menu = menu('Header Menus'))
                <ul class="mobileCate">
                    <li><a href="{{route('index')}}">Home</a></li>
                    @foreach($menu->subMenus as $menu)
                    <li>
                        @if($menu->subMenus->count() > 0)
                        <span class="downMenus">
                            <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                            <i class="fa fa-angle-down"></i>
                        </span>
                        <ul>
                        @foreach($menu->subMenus as $menu)
                            <li><a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a></li>
                        @endforeach
                        </ul>
                        @else
                        <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif

                <div class="pm-menu-account">
                    @if(Auth::check())
                        <a href="{{route('customer.dashboard')}}" class="pm-btn-primary"><i class="fa fa-user"></i> My Account</a>
                    @else
                        <a href="{{route('login')}}" class="pm-btn-primary"><i class="fa fa-sign-in"></i> Login</a>
                        <a href="{{route('register')}}" class="pm-btn-outline"><i class="fa fa-user-plus"></i> Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


