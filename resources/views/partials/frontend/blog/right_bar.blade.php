<aside class="col-lg-4">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
    <header>
        <h3 class="h6">Search the blog</h3>
    </header>
    <form action="#" class="search-form">
        <div class="form-group">
        <input type="search" placeholder="What are you looking for?">
        <button type="submit" class="submit"><i class="icon-search"></i></button>
        </div>
    </form>
    </div>
    <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
        <header>
            <h3 class="h6">Latest Posts</h3>
        </header>
        <div class="blog-posts">
            @isset($latestPosts)
                @foreach($latestPosts as $post)
                <a href="{{ route('blog_details', [ 'post_id' => $post->id ]) }}">
                    <div class="item d-flex align-items-center">
                        <div class="image"><img src="https://via.placeholder.com/60" alt="..." class="img-fluid"></div>
                        <div class="title">
                            <strong>{{ $post->title }}</strong>
                            <div class="d-flex align-items-center">
                                <div class="views"><i class="icon-clock"></i> {{ relative_time($post->created_at) }}</div>
                                <div class="views"><i class="icon-eye"></i> {{ $post->total_viewed ?? '' }}</div>
                                <!-- <div class="comments"><i class="icon-comment"></i>12</div> -->
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            @endisset
        </div>
    </div>
    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
    <header>
        <h3 class="h6">Categories</h3>
    </header>
    @isset($popularCategories)
        @foreach($popularCategories as $category)
        <div class="item d-flex justify-content-between">
            <a href="{{ route('blog_category', [ 'category_id' => $category->id ]) }}">{{ $category->alias ?? '' }}</a>
            <span>{{ $category->posts->count() ?? '' }}</span>
        </div>
        @endforeach
    @endisset
    </div>
    <!-- Widget [Tags Cloud Widget]-->
    <!-- <div class="widget tags">
    <header>
        <h3 class="h6">Tags</h3>
    </header>
    <ul class="list-inline">
        <li class="list-inline-item"><a href="#" class="tag">#Business</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Technology</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Fashion</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Sports</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Economy</a></li>
    </ul>
    </div> -->
</aside>
