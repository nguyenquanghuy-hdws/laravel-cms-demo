@extends('layouts.frontend')

@section('tittle', 'Blog | CRM Demo')
@section('description', 'Description for blogpage')

@section('content')
<div class="container">
    <div class="row">
    <!-- Latest Posts -->
    <main class="posts-listing col-lg-8">
        <div class="container">
            @isset($posts)
            <div class="row">
                <!-- post -->
                @forelse ($posts as $post)
                    <div class="post col-xl-6">
                        <div class="post-thumbnail"><a href="{{ route('blog_details', [ 'post_id' => $post->id ]) }}"><img src="https://via.placeholder.com/350x250" alt="..." class="img-fluid"></a></div>
                        <div class="post-details">
                            <div class="post-meta d-flex justify-content-between">
                                <div class="date meta-last">{{ $post->created_at }}</div>
                                <div class="category"><a href="#">Business</a></div>
                            </div>
                            <a href="{{ route('blog_details', [ 'post_id' => $post->id ]) }}">
                                <h3 class="h4">{{ $post->title }}</h3>
                            </a>
                            <p class="text-muted">{{ short_text($post->content, 0, 110, '...') }}</p>
                            <footer class="post-footer d-flex align-items-center">
                                <a href="#" class="author d-flex align-items-center flex-wrap">
                                    <div class="avatar"><img src="https://via.placeholder.com/40" alt="..." class="img-fluid"></div>
                                    <div class="title">
                                        <span>{{ $post->creator->name }}</span>
                                    </div>
                                </a>
                                <div class="date"><i class="icon-clock"></i> {{ relative_time($post->created_at) }}</div>
                                <div class="views"><i class="icon-eye"></i> {{ $post->total_viewed ?? '' }}</div>
                                <!-- <div class="comments meta-last"><i class="icon-comment"></i>12</div> -->
                            </footer>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">Empty post</div>
                @endforelse
            </div>
            <!-- Pagination -->
            {{ $posts->appends(request()->except('page'))->links('vendor.pagination.blog') }}
            @endisset
        </div>
    </main>
    @include('partials.frontend.blog.right_bar')
    </div>
</div>
@endsection
