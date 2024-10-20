
@extends('layouts.master')


@extends('layouts.app')
@section('content')
<div class="container" >
    <div class="row justify-content-center" style="margin:200px 0">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('message'))
                        <p>{{session('message')}}</p>
                    @endif
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Verify your Email Address') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
