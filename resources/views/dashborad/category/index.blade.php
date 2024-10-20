@extends('layouts.dashboradmaster')

@section('content')

<div class="row">

    <div class="col-6">
        <div class="card">
            <div class="card-head p-3">
                <h3>Category Table</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-danger text-center">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody class="text-center">
                        @foreach ($categories as $category )
                        <tr>
                            <th scope="row">{{$loop->index +1}}</th>
                            <td>
                                <img src="{{asset('uploads/category')}}/{{$category->image}}" alt="" width="50px" height="50px" style="border-radius: 10px">
                            </td>
                            <td>{{$category->title}}</td>
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')

                            <td>
                                <a href="{{route('category.action',$category->id)}}" class="@if ($category->status == 'active') btn bg-success text-white @else btn bg-danger text-white @endif ">{{$category->status}}</a>
                            </td>
                            <td>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                            @endif

                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
        <div class="col-6">
            <div class="card">
                <div class="cord-head p-3">
                    <h3>Add Category</h3>
                </div>
                <div class="cord-body p-3">
                    <form role="form" action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="title" name="title">
                                @error('title')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Category Slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="slug" name="slug">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Category Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="inputEmail3" placeholder="image" name="image">
                                @error('image')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>


@endsection


@section('script')
    <script>

        @if(session('create_category'))
            Toastify({
            text: "{{session('create_category')}}",
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
