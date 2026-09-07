@extends(welcomeTheme().'layouts.app') @section('title')
<title>{{websiteTitle($category->seo_title?:$category->name)}}</title>
@endsection @section('SEO')
<meta name="title" property="og:title" content="{{websiteTitle($category->seo_title?:$category->name)}}" />
<meta name="description" property="og:description" content="{!!$category->seo_description?:general()->meta_description!!}" />
<meta name="keywords" content="{{$category->seo_keyword?:general()->meta_keyword}}" />
<meta name="image" property="og:image" content="{{asset($category->image())}}" />
<meta name="url" property="og:url" content="{{route('blogCategory',$category->slug?:'no-title')}}" />
<link rel="canonical" href="{{route('blogCategory',$category->slug?:'no-title')}}">
@endsection @push('css')
<style>

</style>
@endpush 

@section('contents')

<!-- Start of Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title mb-0">{{$category->name}} </h1>
    </div>
</div>
<!-- End of Page Header -->

<!-- Start of Breadcrumb -->
<nav class="breadcrumb-nav mb-10">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('index')}}">Home </a></li>
            <li>{{$category->name}} </li>
        </ul>
    </div>
</nav>
<!-- End of Breadcrumb -->


<!-- Start of Page Content -->
<div class="page-content">
    <div class="container">

        <div class="row grid cols-xl-4 cols-lg-3 cols-md-2 mb-2" data-grid-options="{
            'layoutMode': 'fitRows'
        }">
            @foreach($posts as $post)
            <article class="post post-grid-type grid-item overlay-zoom fashion">
                <figure class="post-media br-sm">
                    <a href="{{route('blogView',$post->slug?:'no-title')}}">
                        <img src="{{asset($post->image())}}" width="600"
                            height="420" alt="blog">
                    </a>
                </figure>
                <div class="post-details" style="text-align: center;">
                     <h4 class="post-title">
                         <a href="{{route('blogView',$post->slug?:'no-title')}}">
                             {{$post->name}}
                        </a>
                     </h4>
                     <a href="{{route('blogView',$post->slug?:'no-title')}}" class="btn btn-link btn-white btn-underline">Read More <i class="w-icon-long-arrow-right"></i></a>
                 </div>
            </article>
            @endforeach
        </div>
        <!-- pagination -->
		{{$posts->links(welcomeTheme().'blogs.pagination')}}
    </div>
</div>
<!-- End of Page Content -->

@endsection @push('js') @endpush