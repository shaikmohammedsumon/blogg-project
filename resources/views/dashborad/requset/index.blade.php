@extends('layouts.dashboradmaster')
@section('content')


<div class="row ">
    @foreach ($requests as $request)    
    <div class="col-3 my-2">
        <!-- Simple card -->
        <div class="card">
            @if ($request->oneUser->image == 'default.jpg')
            <img class="card-img-top img-fluid" src="{{asset('uploads/profile_default/default.jpg')}}" alt="Card image cap">
            @else
            <img class="card-img-top img-fluid" src="{{asset('uploads/profile')}}/{{$request->oneUser->image}}" alt="Card image cap" style="height: 300px;">
            @endif
            <div class="card-body">
                <h5 class="card-title">Feedback</h5>
                <p class="card-text">Name : {{ $request->oneUser->name}}</p>
                <p class="card-text">Email : {{ $request->oneUser->email}}</p>
                <h4>Massege</h4>
                <p class="card-text">{{ $request->feedback}}</p>

                <a href="{{route('request.cancel',$request->id)}}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                <a href="{{route('request.accept',$request->id)}}" class="btn btn-primary waves-effect waves-light">Accapt</a>
            </div>
        </div>
    </div> 
    
    @endforeach
</div>


@endsection