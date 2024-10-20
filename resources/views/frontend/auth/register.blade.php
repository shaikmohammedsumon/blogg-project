@extends('layouts.master')

@section('contend')

<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign up</h4>
                    <!--form-->              
                    <form  class="sign-form widget-form" action="{{route('gest.register.post')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Username*" name="name" value="">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address*" name="email" value="">
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control @error('Password') is-invalid @enderror" placeholder="Password*" name="password" value="">
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                    </form>
                    <p class="form-group text-center">Already have an account? <a href="{{route('gest.login')}}" class="btn-link">Login</a> </p>
                       <!--/-->
                </div> 
            </div>
         </div>
    </div>
</section>       
    
@endsection