@extends('layouts.dashboradmaster')

@section('content')

<div class="row">
    <div class="col-6">
        <div class="card-body">
            <h4 class="header-title mb-3">Name Update form</h4>

            <form action="{{route('home.profile.name.update')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="name" name="name" value="{{old('name')}}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="col-6">
        <div class="card-body">
            <h4 class="header-title mb-3">Email Update form</h4>

            <form action="{{route('home.profile.email.update')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputEmail3" placeholder="email" name="email" value="{{old('email')}}">
                        @error('email')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<br><br><br>
<br><br><br>

<div class="row">
    <div class="col-6">
        <div class="card-body">
            <h4 class="header-title mb-3">Password Update form</h4>
            <form action="{{route('home.profile.password.update')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Old Passwoed</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="inputEmail3" placeholder="current password" name="current_password" value="{{old('current_password')}}">
                        @error('current_password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        @error('error_pass')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">New Passwoed</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputEmail3" placeholder="new password" name="password" value="{{old('password')}}">
                        @error('password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Confirm Passwoed</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputEmail3" placeholder="password confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
                        @error('password_confirmation')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>


                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-6">
        <div class="card-body">
            <h4 class="header-title mb-3">Image Update form</h4>
            <form action="{{route('home.profile.image.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">image</label>
                    <div class="col-sm-9">
                        @if (auth()->user()->image == 'default.jpg')
                        <picture>
                            <img id="port_image" src="{{asset('uploads/profile_default')}}/{{auth()->user()->image}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
                        </picture>
                        @else     
                        <picture>
                            <img id="port_image" src="{{asset('uploads/profile')}}/{{auth()->user()->image}}" alt="" style="width:100%; height: 200px; object-fit:contain;">
                        </picture>
                        @endif
                        <input onchange="document.getElementById('port_image').src =window.URL.createObjectURL(this.files[0]) " type="file" class="form-control @error('image') is-invalid @enderror" id="inputEmail3" placeholder="image" name="image" value="{{old('image')}}">
                        @error('current_password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        @error('image')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                        
                    </div>
                </div>


                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

    @if(session('profile_update'))
        Toastify({
        text: "{{session('profile_update')}}",
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