@extends('layouts.dashboradmaster')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Connected form</h4>

                    <form role="form" action="{{route('connected.createdd')}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Connected Icon</label>
                            <div class="col-sm-9">
                                <input type="name" class="form-control @error('icon') is-invalid @enderror" id="inputEmail3" placeholder="Icon" name="icon">
                                @error('icon')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Connected Name</label>
                            <div class="col-sm-9">
                                <input type="name" class="form-control @error('name') is-invalid @enderror" id="inputEmail3" placeholder="Name" name="name">
                                @error('name')
                                    <p class="text-danger">{{ $message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Connected Link</label>
                            <div class="col-sm-9">
                                <input type="link" class="form-control @error('links') is-invalid @enderror" id="inputEmail3" placeholder="link" name="links">
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

        <div class="col-6">
            <div class="card">
                <div class="card-head p-3">
                    <h3>Connected Table</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-danger text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Links</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach ($connecteds as $connected )
                            <tr>
                                <th scope="row">{{$loop->index +1}}</th>
                                <td>{{$connected->icon}}</td>
                                <td>{{$connected->name}}</td>
                                <td>{{ Str::limit($connected->links,20)}}..</td>
                                <td>
                                    <a href="{{route('connected.action',$connected->id)}}" class="@if ($connected->status == 'active') btn bg-success text-white @else btn bg-danger text-white @endif ">{{$connected->status}}</a>
                                </td>
                                <td>
                                    <a href="{{route('connected.edit',$connected->id)}}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('connected.delete',$connected->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>

                            </tr>
                            @endforeach

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

        @if(session('create_connected'))
            Toastify({
            text: "{{session('create_connected')}}",
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



    <script>

        @if(session('connected_update'))
            Toastify({
            text: "{{session('connected_update')}}",
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


<script>

    @if(session('connected_delete'))
        Toastify({
        text: "{{session('connected_delete')}}",
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
