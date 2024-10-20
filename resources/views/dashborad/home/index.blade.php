@extends('layouts.dashboradmaster')


@section('content')


@if (auth()->user()->role == 'user')    
<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Do youe send Request</h4>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="mdi mdi-help-circle me-1 text-primary"></i>Do you want to a Blogger!!
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">
                            
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Request From</h4>

                                        @if (!$requests)
                                        <form role="form" action="{{route('request.sent',Auth::user()->id)}}" method="POST">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Feedback</label>
                                                <div class="col-sm-9">
                                                    <textarea type="text" class="form-control" id="inputEmail3" placeholder="feadback" name="feedback" rows="5"> </textarea>
                                                </div>
                                            </div>

                                            <div class="justify-content-end row">
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Send Request</button>
                                                </div>
                                            </div>
                                        </form>
                                        @else
                                            <h3 class="text-center text-success">Already Requested</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end accordion -->
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>

@endif

@endsection