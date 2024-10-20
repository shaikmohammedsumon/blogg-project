@extends('layouts.master')

@section('contend')

<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>All Blogs</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <!--post 1-->


                 @forelse ($blogs as $blog )
                 <div class="post-list post-list-style2">
                    <div class="" style="width: 500px; height: 300px; object-fit: cover; margin:20px;">
                        <a href="{{route('frontend.blog.singel.index',$blog->id)}}"  style="width: 500px; height: 300px; object-fit: cover;">
                            <img src="{{asset('uploads/blog')}}/{{$blog->thumbnail}}" alt=""  style="width: 500px; height: 300px; object-fit: cover;">
                        </a>
                    </div>


                    <div class="post-list-content">
                        <h3 class="entry-title">
                            <a href="{{route('frontend.blog.singel.index',$blog->id)}}">{{ $blog->title}}</a>
                        </h3>
                        <ul class="entry-meta">
                            @if ($blog->oneUser->image == 'default.jpg')
                            <li class="post-author-img"><img src="{{Avatar::create($blog->oneUser->name)->toBase64()}}" alt=""></li>
                            @else
                            <li class="post-author-img"><img src="{{asset('uploads/profile/')}}/{{$blog->oneUser->image}}" alt=""></li>
                            @endif
                            <li class="post-author"> <a href="author.html">{{$blog->oneUser->name}}</a></li>
                            <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{$blog->oneUser->role}}</a></li>
                            <li class="post-date"> <span class="line"></span> {{ Carbon\Carbon::parse($blog->created_at)->format('F-d-y') }}</li>
                        </ul>
                        <div class="post-exerpt">
                            <p>{!!Str::limit($blog->short_descripion,150,'...')!!}</p>
                        </div>
                        <div class="post-btn">
                            <a href="{{route('frontend.blog.singel.index',$blog->id)}}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                 @empty
                <h1 style="text-align: center; color:red;">No Data Founds</h1>
                 @endforelse

             </div>
         </div>
     </div>
 </section>
@endsection
