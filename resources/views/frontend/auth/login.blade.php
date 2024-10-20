@extends('layouts.master')
@section('contend')
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Login</h4>
                    <p></p>
                    <form class="sign-form widget-form" action="{{route('gest.login.post')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control @error('name') is-invalid @enderror" placeholder="email*" name="email" value="">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" value="">
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="#" class="btn-link ">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Login in</button>
                        </div>
                    </form>
                    <p class="form-group text-center">Don't have an account? <a href="{{route('gest.register')}}" class="btn-link">Create One</a> </p>
                </div> 
            </div>
        </div>
    </div>
</section> 


@if (session('register_success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
        icon: "success",
        title: "{{session('register_success')}}"
    });
</script>
@endif
@endsection