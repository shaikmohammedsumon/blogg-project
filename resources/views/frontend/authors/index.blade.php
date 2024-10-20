@extends('layouts.master')
@section('contend')

<section class="authors">
    <div class="container-fluid">
        <div class="row">
            <!--author-image-->
            <div class="col-lg-12 col-md-12 ">
                    <div class="authors-info">
                    <div class="image">
                        <a href="author.html" class="image">
                            <img src="assets/img/author/1.jpg" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <h4 >Sarah Jessica</h4>
                        <p>
                             Etiam vitae dapibus rhoncus. Eget etiam aenean nisi montes felis pretium donec veni. Pede vidi condimentum et aenean hendrerit.
                            Quis sem justo nisi varius.
                        </p>
                        <div class="social-media">
                            <ul class="list-inline">
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" >
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/-->
            </div>
        </div>
    </div>
</section>

<!-- blog-author-->
<section class="blog-author mt-30">
    <div class="container-fluid">
        <div class="row">
            <!--content-->
            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <!--post1-->
                    @foreach ($blogs as $blog)

                    <div class="post-list post-list-style4 pt-0">
                        <div class="post-list-image">
                            <a href="{{route('frontend.blog.singel.index',$blog->id)}}">
                                <img src="{{asset('uploads/blog')}}/{{$blog->thumbnail}}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <ul class="entry-meta">
                                <li class="entry-cat">
                                    <a href="{{route('frontend.blog.singel.index',$blog->id)}}" class="category-style-1">{{$blog->oneCategory->title}}</a>
                                </li>
                                <li class="post-date"> <span class="line"></span> </span> {{ Carbon\Carbon::parse($blog->created_at)->format('F-d-y') }}</li>
                            </ul>
                            <h5 class="entry-title">
                                <a href="{{route('frontend.blog.singel.index',$blog->id)}}">{{$blog->title}}</a>
                            </h5>
                            <div class="post-btn">
                                <a href="{{route('frontend.blog.singel.index',$blog->id)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    <!--/-->
                    <!--pagination-->
                    <div class="pagination">
                        <div class="pagination-area text-left">
                            {{$blogs->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->

            <!--Sidebar-->
            <div class="col-lg-4 oredoo-sidebar">
                <div class="theiaStickySidebar">
                    <div class="sidebar">
                        <!--search-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Search</h5>
                            </div>
                            <div class=" widget-search">

                                <form action="{{route('search.post')}}" method="POST">
                                    @csrf
                                    <input type="search" id="gsearch" name="search_text" placeholder="Search ...." >
                                    <button class="btn-submit" type="submit"><i class="las la-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <!--popular-posts-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>popular Posts</h5>
                            </div>

                            <ul class="widget-popular-posts">
                                <!--post1-->

                                @foreach ($popularPosts as $popularPost)

                                <li class="small-post">
                                    <div class="small-post-image">
                                        <a href="{{route('frontend.blog.singel.index',$popularPost->id)}}">
                                            <img src="{{asset('uploads/blog')}}/{{$popularPost->thumbnail}}" alt="">
                                            <small class="nb">{{$popularPost->view_count}} </small>
                                        </a>
                                    </div>
                                    <div class="small-post-content">
                                        <p>
                                            <a href="{{route('frontend.blog.singel.index',$popularPost->id)}}">{{$popularPost->title}}</a>
                                        </p>
                                        <small> <span class="slash"></span>{{ Carbon\Carbon::parse($popularPost->created_at)->format('F-d-y') }}</small>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                        <!--newslatter-->

                        <!--stay connected-->
                        <div class="widget ">
                            <div class="widget-title">
                                <h5>Stay connected</h5>
                            </div>

                            <div class="widget-stay-connected">
                                <div class="list">
                                    @foreach ($connecteds as $connected )
                                        <div class="item bg-success">
                                            <a href="{{$connected->links}}"><i class="{{$connected->icon}}"></i></a>
                                            <a href="{{$connected->links}}"><p>{{$connected->name}}</p></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                        <!--Tags-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Tags</h5>
                            </div>
                            <div class="widget-tags">
                                <ul class="list-inline">
                                    @foreach ($categorys as $category)
                                    <li>
                                        <a href="{{route('Frontend.cat.blog',$category->slug)}}">{{$category->title}}</a>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>
</section>

@endsection
