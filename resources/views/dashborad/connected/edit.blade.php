@extends('layouts.dashboradmaster')

@section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Connected form</h4>

            <form role="form" action="{{route('connected.update',$connecteds->id)}}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Connected Name</label>
                    <div class="col-sm-9">
                        <input type="name" class="form-control @error('icon') is-invalid @enderror" id="inputEmail3" placeholder="Name" name="icon" value="{{$connecteds->icon}}">
                        @error('icon')
                            <p class="text-danger">{{ $message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Connected Name</label>
                    <div class="col-sm-9">
                        <input type="name" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="Name" name="name" value="{{$connecteds->name}}">
                        @error('name')
                            <p class="text-danger">{{ $message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Connected Link</label>
                    <div class="col-sm-9">
                        <input type="link" class="form-control @error('links') is-invalid @enderror" id="inputEmail3" placeholder="link" name="links" value="{{$connecteds->links}}">
                        @error('name')
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


@endsection

