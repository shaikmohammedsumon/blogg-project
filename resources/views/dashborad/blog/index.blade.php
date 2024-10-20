@extends('layouts.dashboradmaster')

@section('title')
    bloge page
    
@endsection

@section('content')
<x-breadcum sumon="Blog's Show Page" > </x-breadcum>
<h1>Blog</h1>

<div class="col-12">
    <div class="card">
        <div class="card-head p-3">
            <h3>blog Table</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-danger text-center">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category Title</th>
                            <th>View Blog</th>

                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                                <th>Status</th>
                                <th>Feature</th>
                                <th>Action</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach ($blogs as $blog )    
                    <tr>
                        <th scope="row">{{$loop->index +1}}</th>
                        <td>
                            <img src="{{asset('uploads/blog')}}/{{$blog->thumbnail}}" alt="" width="50px" height="50px" style="border-radius: 10px">
                        </td>
                        <td class="text-start">{{$blog->title}}</td>
                        <td>
                            {{$blog->oneCategory->title}}
                        </td>
                        <td>
                            <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#showView{{$blog->id}}">
                                <i class="fa-solid fa-street-view btn btn-light"></i>
                            </a>
                        </td>
                        

                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                        
                        <td>
                            <a href="{{route('blog.action',$blog->id)}}" class="@if ($blog->status == 'active') btn bg-success text-white @else btn bg-danger text-white @endif ">{{$blog->status}}</a>   
                        </td>

                        <td>
                            <a href="{{route('blog.feature',$blog->id)}}" class="@if ($blog->feature == '1') btn bg-success text-white @else btn bg-danger text-white @endif ">@if ($blog->feature == '1')
                                Feature Active
                            @else
                                Feature Deactive
                            @endif</a>   
                        </td>

                        <td>
                            <a href="{{route('blog.edit',$blog->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{route('blog.destroy',$blog->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        @endif

                    </tr>


                    <!-- Modal -->

                        <div class="modal fade" id="showView{{$blog->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> {{$blog->id}} - {{$blog->title}} </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                
                                    <div class="modal-body">
                                        <img src="{{asset('uploads/blog')}}/{{$blog->thumbnail}}" alt="">
                                        <p>{!!$blog->short_descripion!!}</p>
                                        <p>{!!$blog->long_descripion!!}</p>
                                    </div>

                                    
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>



                    


                    @endforeach 
                    
                </tbody>
                
                {{$blogs->links()}}
                </table>
            </div>
        </div>
    </div>

</div>



    
@endsection


@section('script')

<script>

    @if(session('success'))
        Toastify({
        text: "{{session('success')}}",
        duration: 3000,
        destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function(){} // Callback after click
        }).showToast();
        
    @endif
    
</script> 
    
@endsection