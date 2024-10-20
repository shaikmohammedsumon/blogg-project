@extends('layouts.dashboradmaster')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-head p-3">
                    <h3>contract Table</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-danger text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Massege</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach ($contracts as $contract )
                            <tr>
                                <th scope="row">{{$loop->index +1}}</th>
                                <td>{{$contract->name}}</td>
                                <td>{{$contract->email}}</td>
                                <td>{{$contract->subject}}</td>
                                <td>{{$contract->massege}}</td>

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
