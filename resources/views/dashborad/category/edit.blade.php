@extends('layouts.dashboradmaster')

@section('content')

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="cord-head p-3">
                <h3>Update Category</h3>
            </div>
            <div class="cord-body p-3">
                <form role="form" action="{{route('category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputEmail3" placeholder="title" name="title"value="{{$category->title}}">
                            @error('title')
                                <p class="text-danger">{{ $message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="slug" name="slug" value="{{$category->slug}}">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Image</label>
                        <div class="col-sm-9">

                            <picture>
                            <img id="port_image" src="{{asset('uploads/category')}}/{{$category->image}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
                            </picture>
                            <input onchange="document.getElementById('port_image').src =window.URL.createObjectURL(this.files[0])" type="file" class="form-control @error('image') is-invalid @enderror" id="inputEmail3" placeholder="image" name="image" value="{{$category->image}}">
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
</div>
    
@endsection