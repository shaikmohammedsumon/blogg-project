@extends('layouts.dashboradmaster')

@section('content')

<div class="row">
    <div class="col-6">
            <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Role & User Registration </h4>
    
                <form action="{{route('management.store')}}" method="POST">
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


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputEmail3" placeholder="email" name="email" value="{{old('email')}}">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputEmail3" placeholder="password" name="password" value="{{old('password')}}">
                            @error('password')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Roel</label>
                        <div class="col-sm-9">
                           <select name="role" id="" class="form-select">
                                <option value="">Select Roles</option>
                                <option value="manager">Manager</option>
                                <option value="blogger">Blogger</option>
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


    <div class="col-6">
        <div class="card">
            <div class="card-head p-3">
                <h3>Manager Table</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-danger text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        @forelse ($managers as $manager )    
                        <tr>
                            <th scope="row">{{$loop->index +1}}</th>
                            <td>{{$manager->name}}</td>
                            <td>{{$manager->role}}

                            </td>
                            @if (Auth::user()->role == 'admin')
                                <td>
                                    <form action="{{route('management.role.down',$manager->id)}}" method="POST" id="pass_id{{$manager->id}}">
                                        @csrf
                                        <div class="form-check form-switch d-flex align-items-center justify-content-center">
                                            <input onchange="document.querySelector('#pass_id{{$manager->id}}').submit()" name="role" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $manager->role == 'manager' ?'checked' : ''}}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{route('management.edit',$manager->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('management.delete',$manager->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-danger">no data found</td>
                            </tr>
                        @endforelse 
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    <div class="col-6">
        <div class="card">
            <div class="card-head p-3">
                <h3>Blogger Table</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-danger text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        @forelse ($bloggers as $manager )    
                        <tr>
                            <th scope="row">{{$loop->index +1}}</th>
                            <td>{{$manager->name}}</td>
                            @if (Auth::user()->role == 'admin')
                            <td>
                                <form action="{{route('management.blogger.change.role',$manager->id)}}" method="POST"  id="pass_blogger_id{{$manager->id}}">
                                    @csrf
                                    <select onchange="document.querySelector('#pass_blogger_id{{$manager->id}}').submit()" name="role" id="" class="btn btn-info" style="border: none;">
                                        <option value="{{$manager->role}}">{{$manager->role}}</option>
                                        <option value="manager">Manager</option>
                                        <option value="user">User</option>
                                    </select>
                                </form>
                            </td>

                            
                            <td>
                                <a href="{{route('management.stasus',$manager->id)}}">{{$manager->role}}</a>   
                            </td>
                            <td>
                                <a href="{{route('management.edit',$manager->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{route('management.delete',$manager->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>

                            </td>
                            @else
                                <td>{{$manager->role}}</td>
                            @endif

                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-danger">no data found</td>
                            </tr>
                        @endforelse 
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-head p-3">
                <h3>User Table</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-danger text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                    <th>Action</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody class="text-center">
                        @forelse ($users as $manager )    
                        <tr>
                            <th scope="row">{{$loop->index +1}}</th>
                            <td>{{$manager->name}}</td>
                            @if (Auth::user()->role == 'admin')
                                <td>
                                    <form action="{{route('management.user.change.role',$manager->id)}}" method="POST"  id="pass_user_id{{$manager->id}}">
                                        @csrf
                                        <select onchange="document.querySelector('#pass_user_id{{$manager->id}}').submit()" name="role" id="" class="btn btn-info" style="border: none;">
                                            <option value="{{$manager->role}}">{{$manager->role}}</option>
                                            <option value="manager">Manager</option>
                                            <option value="blogger">Blogger</option>
                                        </select>
                                    </form>
                                </td>
                                
                                <td>
                                    <a href="{{route('management.stasus',$manager->id)}}">{{$manager->role}}</a>   
                                </td>
                                <td>
                                    <a href="{{route('management.edit',$manager->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('management.delete',$manager->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>

                                </td>
                            @else
                                <td>{{$manager->role}}</td>
                            @endif
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-danger">no data found</td>
                            </tr>
                        @endforelse 
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
    
@endsection

@section('script')
<script>

    @if(session('create_user'))
        Toastify({
        text: "{{session('create_user')}}",
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