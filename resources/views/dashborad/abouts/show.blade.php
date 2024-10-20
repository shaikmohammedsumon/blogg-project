@extends('layouts.dashboradmaster')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-head p-3">
            <h3>about Table</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-danger text-center">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach ($abouts as $about )
                    <tr>
                        <th scope="row">{{$loop->index +1}}</th>
                        <td>
                            <img src="{{asset('uploads/abouts')}}/{{$about->image}}" alt="" width="50px" height="50px" style="border-radius: 10px">
                        </td>
                        <td class="text-start">{{$about->title}}</td>
                        <td>
                            <a href="{{route('abouts.action',$about->id)}}" class="@if ($about->status == 'active') btn bg-success text-white @else btn bg-danger text-white @endif ">{{$about->status}}</a>
                        </td>
                        <td>
                            <a href="{{route('abouts.delete',$about->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    @endforeach

                </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection


@section('script')
    <script>

        @if(session('success'))
            Toastify({
            text: "{{session('success')}}",
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

        @if(session('abouts_update'))
            Toastify({
            text: "{{session('abouts_update')}}",
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

    @if(session('abouts_delete'))
        Toastify({
        text: "{{session('abouts_delete')}}",
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
