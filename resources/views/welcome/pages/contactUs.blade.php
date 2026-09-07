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
    :root { --ct-accent: #6d1b7b; --ct-accent-d: #591562; --ct-ink: #2b2333; --ct-muted: #7c7488; --ct-line: #ece7f0; }

    .contact-page { background: #faf8fb; padding: 40px 0 60px; }

    .contact-breadcrumb { font-size: 13px; color: var(--ct-muted); margin-bottom: 26px; }
    .contact-breadcrumb a { color: var(--ct-muted); text-decoration: none; }
    .contact-breadcrumb a:hover { color: var(--ct-accent); }
    .contact-breadcrumb .sep { margin: 0 8px; opacity: .5; }

    .contact-heading { text-align: center; margin-bottom: 34px; }
    .contact-heading h1 { font-size: 28px; font-weight: 800; color: var(--ct-ink); margin: 0 0 8px; }
    .contact-heading p { color: var(--ct-muted); font-size: 14.5px; margin: 0; }

    /* info cards */
    .contact-info-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 34px; }
    .contact-info-card {
        background: #fff; border: 1px solid var(--ct-line); border-radius: 16px;
        padding: 22px 18px; text-align: center;
        transition: transform .18s ease, box-shadow .18s ease;
    }
    .contact-info-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(109,27,123,.10); }
    .contact-info-card .ci-icon {
        width: 52px; height: 52px; margin: 0 auto 14px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%; font-size: 20px;
        color: var(--ct-accent); background: #f3e9f6;
    }
    .contact-info-card h5 { font-size: 14px; font-weight: 700; color: var(--ct-ink); margin: 0 0 6px; }
    .contact-info-card p, .contact-info-card a {
        font-size: 13.5px; color: var(--ct-muted); margin: 0; line-height: 1.6;
        text-decoration: none; word-break: break-word; display: block;
    }
    .contact-info-card a:hover { color: var(--ct-accent); }

    /* main split: map + form */
    .contact-main { display: grid; grid-template-columns: 1fr 1fr; gap: 26px; align-items: stretch; }
    .contact-map, .contact-form-card {
        background: #fff; border: 1px solid var(--ct-line); border-radius: 18px; overflow: hidden;
        box-shadow: 0 6px 22px rgba(0,0,0,.04);
    }
    .contact-map iframe { display: block; width: 100%; height: 100%; min-height: 460px; border: 0; }

    .contact-form-card { padding: 30px 28px; }
    .contact-form-card h4 { font-size: 20px; font-weight: 800; color: var(--ct-ink); margin: 0 0 6px; }
    .contact-form-card .cf-sub { font-size: 13.5px; color: var(--ct-muted); margin: 0 0 22px; }

    .contact-form-card .cf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .contact-form-card .cf-field { margin-bottom: 16px; }
    .contact-form-card label { display: block; font-size: 12.5px; font-weight: 700; color: var(--ct-ink); margin-bottom: 7px; }
    .contact-form-card .form-control {
        width: 100%; border: 1px solid #ddd3e3; border-radius: 10px;
        padding: 12px 14px; font-size: 14px; color: var(--ct-ink);
        background: #fdfcfe; transition: border-color .15s ease, box-shadow .15s ease;
    }
    .contact-form-card .form-control::placeholder { color: #a99fb2; }
    .contact-form-card .form-control:focus {
        outline: none; border-color: var(--ct-accent); background: #fff;
        box-shadow: 0 0 0 3px rgba(109,27,123,.12);
    }
    .contact-form-card textarea.form-control { resize: vertical; min-height: 130px; }
    .contact-form-card .cf-error { color: #d9534f; font-size: 11.5px; margin: 4px 0 0; }

    .btnSendMsg {
        display: inline-flex; align-items: center; gap: 8px;
        background: var(--ct-accent); color: #fff; border: none;
        padding: 12px 30px; border-radius: 10px; font-size: 14.5px; font-weight: 700;
        cursor: pointer; transition: background .15s ease, transform .1s ease;
        box-shadow: 0 6px 16px rgba(109,27,123,.25);
    }
    .btnSendMsg:hover { background: var(--ct-accent-d); }
    .btnSendMsg:active { transform: translateY(1px); }

    .contact-page .alert { border-radius: 10px; font-size: 13.5px; }

    @media (max-width: 991.98px) {
        .contact-info-grid { grid-template-columns: repeat(2, 1fr); }
        .contact-main { grid-template-columns: 1fr; }
        .contact-map iframe { min-height: 320px; }
    }
    @media (max-width: 575.98px) {
        .contact-info-grid { grid-template-columns: 1fr; }
        .contact-form-card { padding: 24px 18px; }
        .contact-form-card .cf-row { grid-template-columns: 1fr; }
        .contact-heading h1 { font-size: 23px; }
    }
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

<div class="contact-page">
    <div class="container">

        <nav class="contact-breadcrumb">
            <a href="{{ url('/') }}">Home</a><span class="sep">/</span>{{ $page->name }}
        </nav>

        <div class="contact-heading">
            <h1>{{ $page->name }}</h1>
            <p>We'd love to hear from you — reach out and our team will get back shortly.</p>
        </div>

        <!-- Info cards -->
        <div class="contact-info-grid">
            <div class="contact-info-card">
                <div class="ci-icon"><i class="fa-solid fa-location-dot"></i></div>
                <h5>Store Address</h5>
                <p>{{ general()->address_one }}</p>
            </div>
            <div class="contact-info-card">
                <div class="ci-icon"><i class="fa-solid fa-phone"></i></div>
                <h5>Call Us</h5>
                <a href="tel:{{ preg_replace('/\s+/', '', general()->mobile) }}">{{ general()->mobile }}</a>
            </div>
            <div class="contact-info-card">
                <div class="ci-icon"><i class="fa-solid fa-envelope"></i></div>
                <h5>Email Us</h5>
                <a href="mailto:{{ general()->email }}">{{ general()->email }}</a>
            </div>
            <div class="contact-info-card">
                <div class="ci-icon"><i class="fa-regular fa-clock"></i></div>
                <h5>Opening Hours</h5>
                <p>Sat – Thu<br>9:00 AM – 10:00 PM</p>
            </div>
        </div>

        <!-- Map + Form -->
        <div class="contact-main">
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.711768033301!2d90.3644656!3d23.757655699999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf004f8efb6b%3A0x4ea30bdd6fc942e2!2sI-7%2C%20Block-E%2C%20Kazi%20Nazrul%20Islam%20Road%2C%20Mohammadpur%2C%20Dhaka-1207!5e0!3m2!1sen!2sbd!4v1726137908930!5m2!1sen!2sbd" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="contact-form-card">
                <h4>Get in touch</h4>
                <p class="cf-sub">Fill in the form below and we'll respond as soon as possible.</p>

                @if(Session::has('success'))
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>Success!</strong> {{ Session::get('success') }}.
                </div>
                @endif

                <form action="{{ route('contactMail') }}" method="post">
                    @csrf
                    <div class="cf-row">
                        <div class="cf-field">
                            <label for="cf-name">Your Name</label>
                            <input type="text" name="name" id="cf-name" class="form-control" placeholder="e.g. Rahim Uddin" value="{{ old('name') }}" />
                            @if ($errors->has('name'))<p class="cf-error">{{ $errors->first('name') }}</p>@endif
                        </div>
                        <div class="cf-field">
                            <label for="cf-email">Your Email</label>
                            <input type="email" name="email" id="cf-email" class="form-control" placeholder="e.g. you@example.com" value="{{ old('email') }}" />
                            @if ($errors->has('email'))<p class="cf-error">{{ $errors->first('email') }}</p>@endif
                        </div>
                    </div>
                    <div class="cf-field">
                        <label for="cf-message">Your Message</label>
                        <textarea name="message" id="cf-message" class="form-control" rows="6" placeholder="How can we help you?">{{ old('message') }}</textarea>
                        @if ($errors->has('message'))<p class="cf-error">{{ $errors->first('message') }}</p>@endif
                    </div>
                    <button type="submit" class="btnSendMsg"><i class="fa-solid fa-paper-plane"></i> Send Message</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection @push('js')

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        document.getElementById("contentForm").submit();
    }
</script>

@endpush
