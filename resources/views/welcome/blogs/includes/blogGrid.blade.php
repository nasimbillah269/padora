<style>
    .blog-card {
        display: flex; flex-direction: column; height: 100%;
        background: #fff; border: 1px solid #ece7f0; border-radius: 16px;
        overflow: hidden; box-shadow: 0 6px 22px rgba(0,0,0,.05);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 18px 38px rgba(109,27,123,.12); }
    .blog-card .bc-thumb {
        display: block; position: relative; aspect-ratio: 16 / 10;
        background: #f3eef6; overflow: hidden;
    }
    .blog-card .bc-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform .35s ease; }
    .blog-card:hover .bc-thumb img { transform: scale(1.06); }
    .blog-card .bc-date {
        position: absolute; left: 12px; top: 12px;
        background: rgba(255,255,255,.94); color: #6d1b7b;
        font-size: 11.5px; font-weight: 700; padding: 5px 12px; border-radius: 999px;
        display: inline-flex; align-items: center; gap: 6px;
    }
    .blog-card .bc-body { padding: 20px; display: flex; flex-direction: column; flex: 1; }
    .blog-card .bc-title {
        font-size: 16.5px; font-weight: 700; line-height: 1.4; margin: 0 0 10px;
        color: #2b2333; text-decoration: none;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .blog-card .bc-title:hover { color: #6d1b7b; }
    .blog-card .bc-excerpt {
        font-size: 13.5px; color: #6f6779; line-height: 1.7; margin: 0 0 16px;
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }
    .blog-card .bc-more {
        margin-top: auto; align-self: flex-start;
        display: inline-flex; align-items: center; gap: 7px;
        background: #6d1b7b; color: #fff; text-decoration: none;
        font-size: 12.5px; font-weight: 700; padding: 9px 18px; border-radius: 9px;
        transition: background .15s ease;
    }
    .blog-card .bc-more:hover { background: #591562; color: #fff; }
</style>

<article class="blog-card">
    <a href="{{ route('blogView', $post->slug ?: 'no-title') }}" class="bc-thumb">
        <img src="{{ asset($post->image()) }}" alt="{{ $post->name }}" loading="lazy">
        <span class="bc-date"><i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}</span>
    </a>
    <div class="bc-body">
        <a href="{{ route('blogView', $post->slug ?: 'no-title') }}" class="bc-title">{{ $post->name }}</a>
        <p class="bc-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($post->short_description), 150) }}</p>
        <a href="{{ route('blogView', $post->slug ?: 'no-title') }}" class="bc-more">Read More <i class="fa-solid fa-angle-right"></i></a>
    </div>
</article>
