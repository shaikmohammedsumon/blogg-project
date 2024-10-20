@extends('layouts.master')
@section('contend')
<!--section-heading-->
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>Contact us</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> pages</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>

<!--contact-->
<section class="contact">
    <div class="container-fluid">
        <div class="contact-area">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-image">
                        <img src="{{asset('dashboard/frontend_assets')}}/img/other/contact.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h3>feel free to contact us</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate deserunt suscipit error deleniti
                            porro, pariatur voluptatem iste quos maxime aspernatur.</p>
                    </div>
                    <!--form-->
                    <form action="{{route('contract.created')}}" method="POST" id="main_contact_form">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name*" >
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email*" >
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="Subject*" >
                            @error('subject')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <textarea name="massege" id="message" cols="30" rows="5" class="form-control @error('massege') is-invalid @enderror" placeholder="massege*" ></textarea>
                            @error('massege')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <button type="submit"  class="btn-custom">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
