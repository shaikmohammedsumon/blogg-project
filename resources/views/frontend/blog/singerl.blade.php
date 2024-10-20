@extends('layouts.master')

@section('contend')
<section class="post-single">
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-lg-12">
                <!--post-single-image-->
                    <div class="post-single-image">
                        <img src="{{asset('uploads/blog')}}/{{$blogs->thumbnail}}" alt="" style="width: 100%; height:700px;">
                    </div>

                    <div class="post-single-body">
                        <!--post-single-title-->
                        <div class="post-single-title">
                            <h2> {{$blogs->title}}</h2>
                            <ul class="entry-meta">
                                @if ($blogs->oneUser->image == 'default.jpg')
                                <li class="post-author-img"><img src="{{Avatar::create($blogs->oneUser->name)->toBase64()}}" alt=""></li>
                                @else
                                <li class="post-author-img"><img src="{{asset('uploads/profile/')}}/{{$blogs->oneUser->image}}" alt=""></li>
                                @endif
                                <li class="post-author"> <a href="author.html">{{$blogs->oneUser->name}}</a></li>
                                <li class="entry-cat"> <a href="blogs-layout-1.html" class="category-style-1 "> <span class="line"></span> {{$blogs->oneUser->role}}</a></li>
                                <li class="post-date"> <span class="line"></span> {{ Carbon\Carbon::parse($blogs->created_at)->format('F-d-y') }}</li>
                            </ul>

                        </div>

                        <!--post-single-content-->
                        <div class="post-single-content">
                            <h3>
                                পোস্ট এর সারমর্ম
                            </h3>
                            <p> {!!$blogs->short_descripion!!}</p>
                            <h3>
                                বিস্তারিত পোস্ট
                            </h3>
                            <p> {!!$blogs->long_descripion!!}</p>
                        </div>

                        <!--post-single-bottom-->
                        <div class="post-single-bottom">
                            <div class="tags">
                                <p>Tags:</p>
                                <ul class="list-inline">
                                    @foreach ($categorys as $category)
                                    <li>
                                        <a href="{{route('Frontend.cat.blog',$category->slug)}}">{{$category->title}}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="social-media">
                                <p>Share on :</p>
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

                        <!--post-single-author-->
                        <div class="post-single-author ">
                            <div class="authors-info">
                                <div class="image">
                                    <a href="#" class="image">
                                        @if ($blogs->oneUser->image == 'default.jpg')
                                            <img src="{{Avatar::create($blogs->oneUser->name)->toBase64()}}" alt="" style="width:100px; height:100px; border-radius:50%;">
                                        @else
                                            <img src="{{asset('uploads/profile/')}}/{{$blogs->oneUser->image}}" alt="" style="width:100px; height:100px; border-radius:50%;">
                                        @endif
                                    </a>
                                </div>
                                <div class="content">
                                    <h4>{{$blogs->oneUser->name}}</h4>
                                    <p> {{$blogs->oneUser->email}}</p>
                                    <div class="social-media">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--post-single-comments-->

                        @auth
                        <div class="post-single-comments">
                            <!--Comments-->
                            <h4>{{ $comments->count() }} Comments</h4>
                            <ul class="comments">



                                <!--comment1-->

                                @foreach ($comments as $comment)

                                    <li class="comment-item pt-0">
                                        @if ($comment->oneUser->image == 'default.jpg')
                                        <img src="{{Avatar::create($comment->oneUser->name)->toBase64()}}" alt="" style="width:40px; height:40px; border-radius:50%;">
                                        @else
                                            <img src="{{asset('uploads/profile/')}}/{{$comment->oneUser->image}}" alt="" style="width:40px; height:40px; border-radius:50%;">
                                        @endif
                                        <div class="content">
                                            <div class="meta">
                                                <ul class="list-inline">
                                                    <li><a href="#">{{ $comment->name}}</a> </li>
                                                    <li class="slash"></li>
                                                    <li>{{Carbon\Carbon::parse($comment->created_at)->format('F-d-y')}}</li>
                                                </ul>
                                            </div>
                                            <p>{{ $comment->comment}}</p>
                                            <a href="#comments" onclick="myFun({{$comment->id}})"  class="btn-reply comment_reply"><i class="las la-reply"></i>Reply</a>
                                        </div>

                                    </li>

                                    @foreach ($comment->replies as $replay)
                                        <li class="comment-item pl-3">
                                            @if ($replay->oneUser->image == 'default.jpg')
                                            <img src="{{Avatar::create($replay->oneUser->name)->toBase64()}}" alt="" style="width:40px; height:40px; border-radius:50%;">
                                            @else
                                                <img src="{{asset('uploads/profile/')}}/{{$replay->oneUser->image}}" alt="" style="width:40px; height:40px; border-radius:50%;">
                                            @endif
                                            <div class="content">
                                                <div class="meta">
                                                    <ul class="list-inline">
                                                        <li><a href="#">{{ $replay->name}}</a> </li>
                                                        <li class="slash"></li>
                                                        <li>{{Carbon\Carbon::parse($replay->created_at)->format('F-d-y')}}</li>
                                                    </ul>
                                                </div>
                                                <p>{{ $replay->comment}}</p>
                                                <a href="#comments" onclick="myFun({{$replay->id}})"  class="btn-reply comment_reply"><i class="las la-reply"></i>Reply</a>
                                            </div>

                                        </li>

                                            @foreach ($replay->replies as $replays)
                                                <li class="comment-item pl-5 pl-5">
                                                    @if ($replays->oneUser->image == 'default.jpg')
                                                    <img src="{{Avatar::create($replays->oneUser->name)->toBase64()}}" alt="" style="width:40px; height:40px; border-radius:50%;">
                                                    @else
                                                        <img src="{{asset('uploads/profile/')}}/{{$replays->oneUser->image}}" alt="" style="width:40px; height:40px; border-radius:50%;">
                                                    @endif
                                                    <div class="content">
                                                        <div class="meta">
                                                            <ul class="list-inline">
                                                                <li><a href="#">{{ $replays->name}}</a> </li>
                                                                <li class="slash"></li>
                                                                <li>{{Carbon\Carbon::parse($replays->created_at)->format('F-d-y')}}</li>
                                                            </ul>
                                                        </div>
                                                        <p>{{ $replays->comment}}</p>
                                                        <a href="#comments" onclick="myFun({{$replays->id}})"  class="btn-reply comment_reply"><i class="las la-reply"></i>Reply</a>
                                                    </div>

                                                </li>
                                            @endforeach
                                    @endforeach

                                @endforeach


                            </ul>
                            <!--Leave-comments-->
                            <div class="comments-form" id="comments">
                                <h4 >Leave a Reply</h4>
                                <!--form-->
                                <form class="form " action="{{route('frontend.blog.comment',$blogs->id)}}" method="POST" id="main_contact_form">
                                    @csrf
                                    <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                    <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                        Your message was sent successfully.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name*" >
                                                <input type="hidden" name="parent_id" id="comment_replay" >

                                                @error('name')
                                                    <p class="text-danger">{{ $message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email*" >
                                                @error('email')
                                                    <p class="text-danger">{{ $message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="comment" id="message" cols="30" rows="5" class="form-control @error('comment') is-invalid @enderror" placeholder="Message*"></textarea>
                                                @error('comment')
                                                    <p class="text-danger">{{ $message}}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">


                                            <button type="submit" class="btn-custom">
                                                Send Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!--/-->
                            </div>
                        </div>
                        @endauth



                    </div>
            </div>
        </div>
    </div>
</section>

<script>

    let comment_replay = document.querySelector('#comment_replay');
    function myFun(id){
        comment_replay.value = id;


    }
</script>


@endsection



