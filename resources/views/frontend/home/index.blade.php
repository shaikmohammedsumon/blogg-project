<!-- blog-slider-->

@extends('layouts.master')

@section('contend')

<section class="blog blog-home4 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel">

                    <!--post1-->

                    @foreach ($features as $feature)
                    <div class="blog-item" style="background-image: url('{{asset('uploads/blog')}}/{{$feature->thumbnail}}')">
                        <div class="blog-banner">
                            <div class="post-overly">
                                <div class="post-overly-content">
                                    <div class="entry-cat">
                                        <a href="{{route('Frontend.cat.blog',$feature->oneCategory->slug)}}" class="category-style-2">Branding</a>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{route('frontend.blog.singel.index',$feature->id)}}">{{$feature->title}}</a>
                                    </h2>
                                    <ul class="entry-meta">
                                        <li class="post-author"> <a href="{{route('Frontend.cat.blog',$feature->oneCategory->slug)}}">{{$feature->oneCategory->title}}</a></li>
                                        <li class="post-date"> <span class="line"></span> {{ Carbon\Carbon::parse($feature->created_at)->format('F-d-y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>

<!-- top categories-->
<div class="categories">
    <div class="container-fluid">
        <div class="categories-area">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="categories-items">

                        @foreach ($categorys as $category)

                        <a class="category-item" href="{{route('Frontend.cat.blog',$category->slug)}}">
                            <div class="image">
                                <img src="{{asset('uploads/category')}}/{{$category->image}}" alt="" style="width:100px; height:80px; object-fit:cover;" >
                            </div>
                            <p style="text-align: center;">{{ $category->title}} <span>{{$category->oneBlog()->count()}}</span> </p>
                        </a>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent articles-->
<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-8 oredoo-content">
                <div class="theiaStickySidebar">
                    <div class="section-title">
                        <h3>recent Articles </h3>
                        <p>Discover the most outstanding articles in all topics of life.</p>
                    </div>

                    <!--post1-->
                    @foreach ($ablogs as $ablog)

                    <div class="post-list post-list-style4">
                        <div class="post-list-image">
                            <a href="{{route('frontend.blog.singel.index',$ablog->id)}}">
                                <img src="{{asset('uploads/blog')}}/{{ $ablog->thumbnail }}" alt="">
                            </a>
                        </div>
                        <div class="post-list-content">
                            <ul class="entry-meta">
                                <li class="entry-cat">
                                    <a href="{{route('Frontend.cat.blog',$ablog->oneCategory->slug)}}" class="category-style-1">{{$ablog->oneCategory->title}}</a>
                                </li>
                                <li class="post-date"> <span class="line"></span> {{Carbon\Carbon::parse($ablog->created_at)->format('F d, Y')}}</li>
                            </ul>
                            <h5 class="entry-title">
                                <a href="{{route('frontend.blog.singel.index',$ablog->id)}}">{{ $ablog->title}}</a>
                            </h5>

                            <div class="post-btn">
                                <a href="{{route('frontend.blog.singel.index',$ablog->id)}}" class="btn-read-more">Continue Reading <i
                                        class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>


                    @endforeach


                    <!--pagination-->
                </div>
            </div>




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
                                        <small> <span class="slash"></span>{{ Carbon\Carbon::parse($feature->created_at)->format('F-d-y') }}</small>
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

