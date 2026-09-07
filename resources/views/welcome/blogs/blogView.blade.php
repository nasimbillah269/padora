@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($post->seo_title?:$post->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($post->seo_title?:$post->name)}}" />
<meta name="description" property="og:description" content="{!!$post->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$post->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($post->image())}}" />
<meta name="url" property="og:url" content="{{route('blogView',$post->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('blogView',$post->slug?:'no-title')}}">
@endsection @push('css')
<style>
    :root { --bl-accent: #6d1b7b; --bl-accent-d: #591562; --bl-ink: #2b2333; --bl-muted: #6f6779; --bl-line: #ece9f1; }

    .blog-single-header {
        padding: 56px 0 50px; text-align: center;
        background: linear-gradient(135deg, #340f3a 0%, #55155f 100%);
    }
    .blog-single-header .bsh-crumb { font-size: 13px; color: rgba(255,255,255,.7); margin-bottom: 14px; }
    .blog-single-header .bsh-crumb a { color: rgba(255,255,255,.7); text-decoration: none; }
    .blog-single-header .bsh-crumb a:hover { color: #fff; }
    .blog-single-header h1 {
        color: #fff; font-size: 32px; font-weight: 800; line-height: 1.3;
        margin: 0 auto 16px; max-width: 780px;
    }
    .blog-single-header .bsh-meta {
        display: inline-flex; flex-wrap: wrap; align-items: center; gap: 18px;
        color: rgba(255,255,255,.82); font-size: 13px;
    }
    .blog-single-header .bsh-meta span { display: inline-flex; align-items: center; gap: 7px; }
    .blog-single-header .bsh-meta i { opacity: .8; }

    .blog-single-wrap { background: #faf8fb; padding: 40px 0 64px; }
    .blog-single-card {
        max-width: 900px; margin: 0 auto;
        background: #fff; border: 1px solid var(--bl-line); border-radius: 18px;
        box-shadow: 0 10px 34px rgba(0,0,0,.06); overflow: hidden;
    }
    .blog-single-card .bsc-feature { width: 100%; aspect-ratio: 16 / 8; object-fit: cover; display: block; background: #f3eef6; }
    .blog-single-card .bsc-inner { padding: 38px 44px 44px; }

    /* rich text */
    .blog-prose { color: #45404e; font-size: 15.5px; line-height: 1.85; }
    .blog-prose > *:first-child { margin-top: 0; }
    .blog-prose > *:last-child { margin-bottom: 0; }
    .blog-prose h1, .blog-prose h2, .blog-prose h3, .blog-prose h4, .blog-prose h5, .blog-prose h6 {
        color: var(--bl-ink); font-weight: 800; line-height: 1.3; margin: 32px 0 12px;
    }
    .blog-prose h2 { font-size: 22px; } .blog-prose h3 { font-size: 19px; } .blog-prose h4 { font-size: 17px; }
    .blog-prose p { margin: 0 0 18px; }
    .blog-prose a { color: var(--bl-accent); text-decoration: underline; text-underline-offset: 2px; }
    .blog-prose a:hover { color: var(--bl-accent-d); }
    .blog-prose ul, .blog-prose ol { margin: 0 0 18px; padding-left: 22px; }
    .blog-prose li { margin-bottom: 8px; }
    .blog-prose ul li::marker { color: var(--bl-accent); }
    .blog-prose img { max-width: 100%; height: auto; border-radius: 12px; margin: 12px 0; }
    .blog-prose blockquote {
        margin: 20px 0; padding: 16px 22px; background: #f6eef8;
        border-left: 4px solid var(--bl-accent); border-radius: 0 10px 10px 0;
        color: #4a3d52; font-style: italic;
    }
    .blog-prose hr { border: 0; border-top: 1px solid var(--bl-line); margin: 28px 0; }
    .blog-prose table { width: 100%; border-collapse: collapse; margin: 18px 0; font-size: 14px; }
    .blog-prose th, .blog-prose td { border: 1px solid var(--bl-line); padding: 10px 12px; text-align: left; }
    .blog-prose th { background: #f6eef8; font-weight: 700; }
    .blog-prose iframe { max-width: 100%; border-radius: 12px; }

    .bsc-back {
        display: inline-flex; align-items: center; gap: 8px; margin-top: 30px;
        color: var(--bl-accent); font-size: 13.5px; font-weight: 700; text-decoration: none;
    }
    .bsc-back:hover { color: var(--bl-accent-d); }

    /* related */
    .blog-related { max-width: 1100px; margin: 46px auto 0; }
    .blog-related h3 {
        font-size: 20px; font-weight: 800; color: var(--bl-ink);
        margin: 0 0 22px; padding-bottom: 10px; position: relative;
    }
    .blog-related h3::after { content: ""; position: absolute; left: 0; bottom: 0; width: 46px; height: 3px; background: var(--bl-accent); }
    .blog-related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }

    @media (max-width: 991.98px) { .blog-related-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 767.98px) {
        .blog-single-header { padding: 40px 0 38px; }
        .blog-single-header h1 { font-size: 24px; }
        .blog-single-wrap { padding: 26px 0 48px; }
        .blog-single-card .bsc-inner { padding: 26px 20px 30px; }
        .blog-related-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('contents')

<div class="blog-single-header">
    <div class="container">
        <nav class="bsh-crumb"><a href="{{ url('/') }}">Home</a> / <a href="{{ url('/blogs') }}">Blogs</a></nav>
        <h1>{{ $post->name }}</h1>
        <div class="bsh-meta">
            <span><i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span>
            @if($post->user)
                <span><i class="fa-regular fa-user"></i> {{ $post->user->name }}</span>
            @endif
        </div>
    </div>
</div>

<div class="blog-single-wrap">
    <div class="container">
        <article class="blog-single-card">
            <img class="bsc-feature" src="{{ asset($post->image()) }}" alt="{{ $post->name }}">
            <div class="bsc-inner">
                <div class="blog-prose">
                    {!! $post->description !!}
                </div>
                <a href="{{ url('/blogs') }}" class="bsc-back"><i class="fa-solid fa-angle-left"></i> Back to all posts</a>
            </div>
        </article>

        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
        <section class="blog-related">
            <h3>Related Posts</h3>
            <div class="blog-related-grid">
                @foreach($relatedPosts as $rp)
                    @include(welcomeTheme().'blogs.includes.blogGrid', ['post' => $rp])
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

@endsection @push('js') @endpush
