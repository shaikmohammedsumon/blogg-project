@extends('layouts.dashboradmaster')

@section('content')

<div class="row">
    <div class="col-6">
        <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Update Manager </h4>

            <form action="{{route('management.update',$manager->id)}}" method="POST">
                @csrf
    
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="name" name="name" value="{{$manager->name}}">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
    
    
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputEmail3" placeholder="email" name="email" value="{{$manager->email}}">
                        @error('email')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
    
    
                {{-- <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputEmail3" placeholder="password" name="password" value="{{$manager->password}}">
                        @error('password')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div> --}}
    
    
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Roel</label>
                    <div class="col-sm-9">
                       <select name="role" id="" class="form-select">
                            <option value="{{$manager->role}}" selected>{{$manager->role}}</option>
                            <option value="blogger">Blogger</option>
                            <option value="manager">Manager</option>
                            <option value="user">User</option>
                       </select>
                        @error('role')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
    
    
    
                <div class="justify-content-end row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Sing In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



</div>

@endsection