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
    :root { --pg-accent: #6d1b7b; --pg-accent-d: #591562; --pg-ink: #2b2333; --pg-muted: #6f6779; --pg-line: #eee9f1; }

    /* ---- Page header ---- */
    .pv-header {
        position: relative;
        padding: 64px 0;
        background: #2b0f31;
        background-image:
            linear-gradient(180deg, rgba(43,15,49,.82), rgba(43,15,49,.92)),
            url('{{ asset($page->image()) }}');
        background-size: cover;
        background-position: center;
        text-align: center;
    }
    .pv-header h1 {
        color: #fff; font-size: 34px; font-weight: 800; margin: 0 0 10px;
        letter-spacing: .01em;
    }
    .pv-header .pv-crumb {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 13px; color: rgba(255,255,255,.75);
    }
    .pv-header .pv-crumb a { color: rgba(255,255,255,.75); text-decoration: none; }
    .pv-header .pv-crumb a:hover { color: #fff; }
    .pv-header .pv-crumb .sep { opacity: .5; }

    /* ---- Content wrapper ---- */
    .pv-body { background: #faf8fb; padding: 46px 0 64px; }
    .pv-card {
        max-width: 900px; margin: 0 auto;
        background: #fff; border: 1px solid var(--pg-line);
        border-radius: 18px; box-shadow: 0 8px 28px rgba(0,0,0,.05);
        padding: 44px 46px;
    }
    .pv-lead {
        font-size: 17px; font-weight: 600; color: var(--pg-ink);
        line-height: 1.6; margin: 0 0 22px;
        padding-left: 16px; border-left: 3px solid var(--pg-accent);
    }
    .pv-divider { height: 1px; background: var(--pg-line); border: 0; margin: 0 0 26px; }

    /* ---- Rich text (dynamic editor content) ---- */
    .pv-prose { color: #45404e; font-size: 15px; line-height: 1.8; }
    .pv-prose > *:first-child { margin-top: 0; }
    .pv-prose > *:last-child { margin-bottom: 0; }
    .pv-prose h1, .pv-prose h2, .pv-prose h3, .pv-prose h4, .pv-prose h5, .pv-prose h6 {
        color: var(--pg-ink); font-weight: 800; line-height: 1.3;
        margin: 34px 0 12px;
    }
    .pv-prose h1 { font-size: 25px; }
    .pv-prose h2 { font-size: 22px; }
    .pv-prose h3 { font-size: 19px; }
    .pv-prose h4 { font-size: 17px; }
    .pv-prose h2, .pv-prose h3 {
        padding-bottom: 8px; border-bottom: 2px solid var(--pg-line); position: relative;
    }
    .pv-prose h2::after, .pv-prose h3::after {
        content: ""; position: absolute; left: 0; bottom: -2px;
        width: 46px; height: 2px; background: var(--pg-accent);
    }
    .pv-prose p { margin: 0 0 16px; }
    .pv-prose a { color: var(--pg-accent); text-decoration: underline; text-underline-offset: 2px; }
    .pv-prose a:hover { color: var(--pg-accent-d); }
    .pv-prose ul, .pv-prose ol { margin: 0 0 16px; padding-left: 22px; }
    .pv-prose li { margin-bottom: 8px; }
    .pv-prose ul li::marker { color: var(--pg-accent); }
    .pv-prose img { max-width: 100%; height: auto; border-radius: 12px; margin: 10px 0; }
    .pv-prose blockquote {
        margin: 18px 0; padding: 14px 20px;
        background: #f6eef8; border-left: 4px solid var(--pg-accent);
        border-radius: 0 10px 10px 0; color: #4a3d52; font-style: italic;
    }
    .pv-prose hr { border: 0; border-top: 1px solid var(--pg-line); margin: 26px 0; }
    .pv-prose table { width: 100%; border-collapse: collapse; margin: 18px 0; font-size: 14px; }
    .pv-prose th, .pv-prose td { border: 1px solid var(--pg-line); padding: 10px 12px; text-align: left; }
    .pv-prose th { background: #f6eef8; color: var(--pg-ink); font-weight: 700; }
    .pv-prose iframe { max-width: 100%; border-radius: 12px; }

    @media (max-width: 767.98px) {
        .pv-header { padding: 44px 0; }
        .pv-header h1 { font-size: 26px; }
        .pv-card { padding: 28px 20px; border-radius: 14px; }
        .pv-lead { font-size: 15.5px; }
        .pv-prose { font-size: 14.5px; }
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

<div class="pv-header">
    <div class="container">
        <h1>{{ $page->name }}</h1>
        <nav class="pv-crumb">
            <a href="{{ url('/') }}">Home</a><span class="sep">/</span><span>{{ $page->name }}</span>
        </nav>
    </div>
</div>

<div class="pv-body">
    <div class="container">
        <article class="pv-card">
            @if($page->short_description)
                <p class="pv-lead">{{ $page->short_description }}</p>
                <hr class="pv-divider">
            @endif
            <div class="pv-prose">
                {!! $page->description !!}
            </div>
        </article>
    </div>
</div>

@endsection @push('js') @endpush
