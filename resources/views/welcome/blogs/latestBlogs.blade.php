@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{$page->seo_title?:websiteTitle($page->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{$page->seo_title?:websiteTitle($page->name)}}" />
<meta name="description" property="og:description" content="{!!$page->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$page->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($page->image())}}" />
<meta name="url" property="og:url" content="{{route('pageView',$page->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('pageView',$page->slug?:'no-title')}}">
@endsection @push('css')
<style>
    .blog-list-header {
        padding: 56px 0; text-align: center;
        background:
            linear-gradient(180deg, rgba(43,15,49,.82), rgba(43,15,49,.92)),
            url('{{ asset($page->image()) }}');
        background-size: cover; background-position: center;
    }
    .blog-list-header h1 { color: #fff; font-size: 32px; font-weight: 800; margin: 0 0 10px; }
    .blog-list-header .blh-crumb { font-size: 13px; color: rgba(255,255,255,.75); }
    .blog-list-header .blh-crumb a { color: rgba(255,255,255,.75); text-decoration: none; }
    .blog-list-header .blh-crumb a:hover { color: #fff; }

    .blog-list-wrap { background: #faf8fb; padding: 46px 0 60px; }
    .blog-list-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; }
    .blog-list-empty { text-align: center; padding: 60px 15px; color: #7c7488; }

    .blog-pagination { margin-top: 40px; }
    .blog-pagination ul.pager, .blog-pagination .pagination { display: flex; justify-content: center; gap: 6px; padding: 0; margin: 0; list-style: none; }
    .blog-pagination li a, .blog-pagination li span {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 38px; height: 38px; padding: 0 10px; border-radius: 9px;
        background: #fff; border: 1px solid #ece7f0; color: #6d1b7b;
        font-size: 13.5px; font-weight: 600; text-decoration: none;
    }
    .blog-pagination li a:hover { background: #f4ecf7; }
    .blog-pagination li.active span, .blog-pagination li .active { background: #6d1b7b; color: #fff; border-color: #6d1b7b; }

    @media (max-width: 991.98px) { .blog-list-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 575.98px) {
        .blog-list-grid { grid-template-columns: 1fr; }
        .blog-list-header { padding: 40px 0; }
        .blog-list-header h1 { font-size: 25px; }
    }
</style>
@endpush

@section('contents')

<div class="blog-list-header">
    <div class="container">
        <h1>{{ $page->name }}</h1>
        <nav class="blh-crumb"><a href="{{ url('/') }}">Home</a> / {{ $page->name }}</nav>
    </div>
</div>

<div class="blog-list-wrap">
    <div class="container">
        @if($posts->count() > 0)
            <div class="blog-list-grid">
                @foreach($posts as $post)
                    @include(welcomeTheme().'blogs.includes.blogGrid')
                @endforeach
            </div>
            <div class="blog-pagination">
                {{ $posts->links(welcomeTheme().'blogs.pagination') }}
            </div>
        @else
            <div class="blog-list-empty"><h5>No blog posts published yet.</h5></div>
        @endif
    </div>
</div>

@endsection @push('js') @endpush
