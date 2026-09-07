<!-- footer part start -->
<style>
/* ===== Footer — professional redesign (same palette) ===== */
footer .footerMainPart {
    background-color: #490650;
    background-image: linear-gradient(180deg, #560a60 0%, #490650 45%);
    padding: 56px 0 38px;
    border-top: 3px solid #e8b84b;
}
footer .footerGrid { margin-bottom: 10px; }
footer .footerGrid h5 {
    color: #fff; font-size: 16px; font-weight: 700;
    letter-spacing: .04em; text-transform: uppercase;
    padding-bottom: 16px; margin-bottom: 18px; position: relative;
}
footer .footerGrid h5::after {
    content: ""; position: absolute; left: 0; bottom: 0;
    width: 38px; height: 3px; border-radius: 3px; background: #e8b84b;
}
footer .footerGrid > p,
footer .footerGrid p {
    color: #d7c6db; font-size: 13.5px; line-height: 1.75; padding-bottom: 9px;
}
footer .footerGrid p b { color: #e8b84b; font-weight: 600; }

footer .footerGrid ul { margin: 0; padding: 0; }
footer .footerGrid ul li { list-style: none; }
footer .footerGrid ul li a {
    color: #d7c6db; font-size: 13.5px; margin-bottom: 0;
    padding: 8px 0; display: inline-flex; align-items: center; gap: 8px;
    transition: color .15s ease, transform .15s ease;
}
footer .footerGrid ul li a::before {
    content: "\203A"; color: #e8b84b; font-size: 17px; line-height: 1;
}
footer .footerGrid ul li a:hover { color: #fff; transform: translateX(4px); }

/* social icons must not get the link arrow */
footer .footerSocialLink ul li a::before { content: none; display: none; }
footer .footerSocialLink ul li a:hover { transform: translateY(-3px); }

/* Call Us */
footer .footerCollUs {
    display: flex; align-items: center; gap: 12px;
    margin-top: 18px; justify-content: flex-start;
}
footer .footerCollUs > div:first-child i {
    width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;
    border-radius: 50%; background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.16); color: #e8b84b; font-size: 16px;
}
footer .footerCollUs span { color: #c6b3cb; font-size: 12px; display: block; }
footer .footerCollUs p { color: #fff !important; font-weight: 700; font-size: 15px; padding: 0; margin: 0; line-height: 1.4; }

/* Newsletter */
footer .newsLetterDiv { margin-top: 4px; }
footer .newsLetterDiv .input-group { position: relative; }
footer .newsLetterDiv .form-control {
    background-color: #001868; border: 1px solid rgba(255,255,255,.14); color: #fff;
    padding: 13px 54px 13px 18px; border-radius: 30px !important;
    font-size: 13.5px; box-shadow: none; height: auto;
}
footer .newsLetterDiv .form-control::placeholder { color: #97a4d4; }
footer .newsLetterDiv .form-control:focus { border-color: #e8b84b; background-color: #04187a; outline: none; }
footer .newsLetterDiv .btn {
    background-color: #e8b84b; color: #3a0640;
    width: 38px; height: 38px; border-radius: 50% !important;
    position: absolute; right: 6px; top: 50%; transform: translateY(-50%);
    margin: 0; display: flex; align-items: center; justify-content: center;
    z-index: 9; transition: background-color .15s ease;
}
footer .newsLetterDiv .btn:hover { background-color: #f2cd73; }

/* Social */
footer .footerSocialLink { margin-top: 22px; }
footer .footerSocialLink ul { margin: 0; padding: 0; display: flex; gap: 10px; }
footer .footerSocialLink ul li { display: inline-flex; }
footer .footerSocialLink ul li a {
    width: 38px; height: 38px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.16);
    color: #fff; transition: all .18s ease;
}
footer .footerSocialLink ul li a i { font-size: 15px; margin: 0; }
footer .footerSocialLink ul li a:hover { background: #e8b84b; border-color: #e8b84b; color: #3a0640; transform: translateY(-3px); }
footer .footerSocialLink ul li a:hover i { color: #3a0640; }

/* Bottom bar */
footer .footerBottomPart { background-color: #0a043e; padding: 16px 0; }
footer .footerBottomPart .row { align-items: center; }
footer .footerBottomPart p { color: #c7cae8; font-size: 13px; margin: 0; line-height: 1.6; }
footer .copyText span a, footer .copyText span a:hover { color: #e8b84b; }
footer .footerBottomImg { text-align: right; }
footer .footerBottomImg img { width: auto; max-width: 100%; max-height: 30px; opacity: .95; }

@media (max-width: 991.98px) {
    footer .footerGrid { margin-bottom: 26px; }
}
@media (max-width: 767.98px) {
    footer .footerMainPart { padding: 40px 0 20px; text-align: center; }
    footer .footerGrid h5::after { left: 50%; transform: translateX(-50%); }
    footer .footerCollUs,
    footer .footerSocialLink ul { justify-content: center; }
    footer .footerGrid ul li a { justify-content: center; }
    footer .footerBottomPart { text-align: center; }
    footer .footerBottomPart .col-md-2 { display: none; }
    footer .footerBottomImg { text-align: center; margin-top: 12px; }
}
</style>

<footer>
    <div class="footerMainPart">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footerGrid">
                        <h5>About Us</h5>
                        <p>
                            {{ general()->title ?: 'Pandora Fashion' }} is your destination for contemporary men's &amp; women's clothing — where timeless style meets everyday comfort. We bring together carefully curated collections, quality fabrics and a smooth shopping experience, all in one place.
                        </p>
                        <div class="collUs footerCollUs">
                            <div>
                                <i class="fa fa-headphones" aria-hidden="true"></i>
                            </div>
                            <div>
                                <span>Call Us:</span>
                                <p>{{general()->mobile}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footerGrid">
                        <h5>Store Location</h5>
                        <p><b>Office:</b> {{general()->address_one}}</p>
                        <p><b>Mail:</b> {{general()->email}}</p>
                        <p><b>Phone:</b> {{general()->mobile}}</p>
                        <p><b>Mon-Sat:</b> 9am – 10pm</p>
                    </div>
                </div>
                
                <div class="col-md-3">
                    @if($menu =menu('Footer Two'))
                    <div class="footerGrid">
                        <h5>{{$menu->name}}</h5>
                        <ul>
                            @foreach($menu->subMenus as $menu)
                            <li>
                                <a href="{{asset($menu->menuLink())}}">{{$menu->menuName()}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                
                <div class="col-md-3">
                    <div class="footerGrid">
                        <h5>Newsletter</h5>
                        <div class="newsLetterDiv">
                            <div id="subscribeemailMsg"></div>
                            <form id="subscirbeForm" data-url="{{route('subscribe')}}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Enter Your Email" name="email" id="subscribeEmail" />
                                    <button class="btn" type="button" id="button-addon2">
                                        <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="subscribeemailMsg" id="subscribeemailMsg"></div>
                            </form>
                        </div>
                     @php
    $general = App\Models\General::first();
@endphp

<div class="footerSocialLink">
    <ul>
        @if(!empty($general?->facebook_link))
            <li>
                <a href="{{ $general->facebook_link }}" target="_blank" title="Facebook">
                    <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                </a>
            </li>
        @endif

        @if(!empty($general?->twitter_link))
            <li>
                <a href="{{ $general->twitter_link }}" target="_blank" title="Twitter / X">
                    <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
                </a>
            </li>
        @endif

        @if(!empty($general?->instagram_link))
            <li>
                <a href="{{ $general->instagram_link }}" target="_blank" title="Instagram">
                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                </a>
            </li>
        @endif

        @if(!empty($general?->linkedin_link))
            <li>
                <a href="{{ $general->linkedin_link }}" target="_blank" title="LinkedIn">
                    <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
                </a>
            </li>
        @endif

        @if(!empty($general?->youtube_link))
            <li>
                <a href="{{ $general->youtube_link }}" target="_blank" title="YouTube">
                    <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                </a>
            </li>
        @endif
    </ul>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footerBottomPart">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="copyText">
                        <p>
                            Copyright © 2026 Pandora – All Rights Reserved.
                            <span>Design & Development By <a href="https://natoreit.com" target="_blank">Natore-IT</a></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <div class="footerBottomImg">
                        <img src="{{asset('welcome/images/payment.png')}}" alt="AJL Sea Food" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer part end -->