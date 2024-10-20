@extends('layouts.master')

@section('contend')
<div class="section-heading ">
    <div class="container-fluid">
        <div class="section-heading-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading-2-title text-left">
                        <h2>Search resultats for :{{$search}}</h2>

                        @php
                        $resultCount = $searchResults->count();
                        @endphp
                        <p class="desc">{{$resultCount}} Articles were found for keyword  <strong>{{$search}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-search" style="transform: none;">
    <div class="container-fluid" style="transform: none;">
        <div class="row" style="transform: none;">

            <div class="col-lg-8 oredoo-content" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 83.9333px;">
                 <!--Post1-->
                    @forelse ($searchResults as $searchResult)

                    <div class="post-list post-list-style1 pt-0">
                        <div class="post-list-image">
                            <a href="{{route('frontend.blog.singel.index',$searchResult->id)}}">
                                <img src="{{asset('uploads/blog')}}/{{$searchResult->thumbnail}}" alt="">
                            </a>
                        </div>
                        <div class="post-list-title">
                            <div class="entry-title">
                                <h5>
                                    <a href="{{route('frontend.blog.singel.index',$searchResult->id)}}">{{$searchResult->title}}</a>
                                </h5>
                            </div>
                        </div>
                        <div class="post-list-category">
                            <div class="entry-cat">
                                <a href="{{route('Frontend.cat.blog',$searchResult->oneCategory->slug)}}" class="category-style-1">{{$searchResult->oneCategory->title}}</a>
                            </div>
                        </div>
                    </div>

                    @empty
                        no Data
                    @endforelse
                </div>
            </div>

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

                       <!--categories-->
                       <div class="widget ">
                        <div class="widget-title">
                            <h5>Categories</h5>
                        </div>
                        <div class="widget-categories">

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
                            <div class="tags">
                                <ul class="list-inline">
                                    @foreach ($categorys as $category)
                                    <li>
                                        <a href="{{route('Frontend.cat.blog',$category->slug)}}">{{$category->title}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!--popular-posts-->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>popular Posts</h5>
                            </div>
                            <ul class="widget-popular-posts">
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
                                        <small> {{ Carbon\Carbon::parse($popularPost->created_at)->format('F-d-y') }}</small>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!--Ads-->
                        <div class="widget">
                            <div class="widget-ads">
                                <img src="assets/img/ads/ads2.jpg" alt="">
                            </div>
                        </div>
                        <!--/-->
                    </div>
               </div>
            </div>


        </div>
    </div>
</div>

@endsection
