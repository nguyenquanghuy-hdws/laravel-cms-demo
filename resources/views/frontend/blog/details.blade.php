@extends('layouts.frontend')

@section('title', 'Blogs | CRM Demo')
@section('description', 'Description for blogdetailpage')

@section('content')
<div class="container">
    <div class="row">
    <!-- Latest Posts -->
    <main class="post blog-post col-lg-8">
        <div class="container">
            @isset($currentPost)
            <div class="post-single">
                <div class="post-thumbnail"><img src="https://via.placeholder.com/730x480" alt="..." class="img-fluid"></div>
                <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                    <div class="category"><a href="#">Business</a><a href="#">Financial</a></div>
                </div>
                <h1>{{ $currentPost->title ?? '' }}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
                <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                    <div class="avatar"><img src="https://via.placeholder.com/40" alt="..." class="img-fluid"></div>
                    <div class="title"><span>{{ $currentPost->creator->name ?? '' }}</span></div></a>
                    <div class="d-flex align-items-center flex-wrap">
                    <div class="date"><i class="icon-clock"></i> {{ relative_time($currentPost->created_at) ?? '' }}</div>
                    <div class="views"><i class="icon-eye"></i> {{ $currentPost->total_viewed ?? '' }}</div>
                    <!-- <div class="comments meta-last"><i class="icon-comment"></i>12</div> -->
                    </div>
                </div>
                <div class="post-body">
                    <p>{{ $currentPost->content ?? '' }}</p>
                </div>
                @auth
                    @if($currentPost->voucher_enable == true && $currentPost->voucher_quantity > 0)
                    <div class="coupon float-right">
                        <div class="coupon-deal">50%</div>
                        <div class='coupon-stamp'>Get your voucher code</div>
                    </div>
                    @endif
                @endauth
                <div class="clearfix"></div>
                <div class="post-tags"><a href="#" class="tag">#Business</a><a href="#" class="tag">#Tricks</a><a href="#" class="tag">#Financial</a><a href="#" class="tag">#Economy</a></div>
                <!-- <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row"><a href="#" class="prev-post text-left d-flex align-items-center">
                    <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                    <div class="text"><strong class="text-primary">Previous Post </strong>
                        <h6>I Bought a Wedding Dress.</h6>
                    </div></a><a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                    <div class="text"><strong class="text-primary">Next Post </strong>
                        <h6>I Bought a Wedding Dress.</h6>
                    </div>
                    <div class="icon next"><i class="fa fa-angle-right">   </i></div></a></div> -->
                <!-- <div class="post-comments">
                    <header>
                    <h3 class="h6">Post Comments<span class="no-of-comments">(3)</span></h3>
                    </header>
                    <div class="comment">
                    <div class="comment-header d-flex justify-content-between">
                        <div class="user d-flex align-items-center">
                        <div class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title"><strong>Jabi Hernandiz</strong><span class="date">May 2016</span></div>
                        </div>
                    </div>
                    <div class="comment-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                    </div>
                    <div class="comment">
                    <div class="comment-header d-flex justify-content-between">
                        <div class="user d-flex align-items-center">
                        <div class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title"><strong>Nikolas</strong><span class="date">May 2016</span></div>
                        </div>
                    </div>
                    <div class="comment-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                    </div>
                    <div class="comment">
                    <div class="comment-header d-flex justify-content-between">
                        <div class="user d-flex align-items-center">
                        <div class="image"><img src="https://d19m59y37dris4.cloudfront.net/blog/1-2-1/img/user.svg" alt="..." class="img-fluid rounded-circle"></div>
                        <div class="title"><strong>John Doe</strong><span class="date">May 2016</span></div>
                        </div>
                    </div>
                    <div class="comment-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                    </div>
                </div> -->
                <!-- <div class="add-comment">
                    <header>
                    <h3 class="h6">Leave a reply</h3>
                    </header>
                    <form action="#" class="commenting-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                        <input type="text" name="username" id="username" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                        <input type="email" name="username" id="useremail" placeholder="Email Address (will not be published)" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                        <textarea name="usercomment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-secondary">Submit Comment</button>
                        </div>
                    </div>
                    </form>
                </div> -->
                </div>
            </div>
            @endisset
            @empty($currentPost)
            <div class="alert alert-warning">Post not found</div>
            @endempty
        </div>
    </main>
    @include('partials.frontend.blog.right_bar')
    </div>
</div>
@endsection
