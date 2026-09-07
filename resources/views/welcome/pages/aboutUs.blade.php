@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection
@push('css')
<style>

</style>
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        event: "page_view",
        page_category: "page",
        page_title: "{{$page->name}}",
        page_url: "{{route('pageView',$page->slug?:'no-title')}}"
    });
</script>
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header" style="background-image: url({{asset($page->image())}}); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="overlayPageHeaderNew">
        <div class="container">
            <h1 class="page-title mb-0">{{$page->name}}</h1>
        </div>
    </div>
</div>
<!-- End of Page Header -->

<!-- about us part start -->
<div class="aboutUsPart">
    <div class="container">
        <h4>About Us</h4>
        <p>
            Welcome to AZL Sea Food, Bangladesh's reliable supplier of premium seafood. We have been committed to delivering the best frozen seafood, both raw and ready to cook, right to your door for almost 7 years. Seafood enthusiasts around the nation choose us because of our dedication to quality and client happiness.
        </p>
        <p>
            We take great delight in offering a broad variety of seafood at AZL Sea Food, which includes black pomfret, squid, octopus, oysters, clams, eel fish, red snapper, lobster, mussels, tuna, shrimp, koi, koral, Indian salmon, lakkha, hamour fish, cuttlefish, snails, and much more. We provide something for every taste, whether you're searching for unusual kinds or everyday favorites.
        </p>
        <p>
            We provide prompt and dependable service from our locations in Pahartali, Soray Para, Chittagong, and Mohammadpur, Dhaka.
        </p>
        <img src="{{asset('welcome/images/SLIDER AJL-01 (1) (1).jpg')}}" alt="AJL Sea Food" />
        <div class="missionVisionPart">
            <div class="row">
                <div class="col-md-6">
                    <div class="missionbox">
                        <h5>Our Mission</h5>
                        <p>
                            Our goal at AZL Sea Food is to serve our clients throughout Bangladesh with the best and freshest seafood available. We are dedicated to providing a wide variety of seafood, from commonplace favorites to unique types, straight to your door. We source our seafood sustainably. Our mission is to bring the delectable tastes of the sea into every home, knowing that every item has been hand-picked and kept to preserve its original freshness and flavor. Our goal is to become the industry leader in seafood distribution by delivering outstanding customer service, convenience, and quality in every encounter.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="missionbox">
                        <h5>Our Mission</h5>
                        <p>
                            At AZL Sea Food, our mission is to be Bangladesh's top seafood supplier, recognized for our steadfast dedication to sustainability, quality, and client happiness. By establishing new benchmarks for freshness, variety, and service, we hope to completely transform how people get access to and enjoy seafood. We see a day when every Bangladeshi home has access to the best seafood, carefully sourced and supplied, by broadening our reach and consistently enhancing our procedures.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about us part end -->

<!-- our team section start -->
{{--<div class="ourTeamPart">
    <div class="container">
        <h4>Meet Our Team</h4>
        <div class="row">
            <div class="col-md-3">
                <div class="teamGrid">
                    <img src="{{asset('welcome/images/team1.jpg')}}" alt="AJL Sea Food" />
                    <ul class="teamSocialLink">
                        <li>
                            <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <h5>Charlotte</h5>
                    <p>Farmer</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="teamGrid">
                    <img src="{{asset('welcome/images/team1.jpg')}}" alt="AJL Sea Food" />
                    <ul class="teamSocialLink">
                        <li>
                            <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <h5>Charlotte</h5>
                    <p>Farmer</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="teamGrid">
                    <img src="{{asset('welcome/images/team1.jpg')}}" alt="AJL Sea Food" />
                    <ul class="teamSocialLink">
                        <li>
                            <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <h5>Charlotte</h5>
                    <p>Farmer</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="teamGrid">
                    <img src="{{asset('welcome/images/team1.jpg')}}" alt="AJL Sea Food" />
                    <ul class="teamSocialLink">
                        <li>
                            <a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <h5>Charlotte</h5>
                    <p>Farmer</p>
                </div>
            </div>
        </div>
    </div>
</div>--}}
<!-- our team section end-->


@endsection @push('js') @endpush