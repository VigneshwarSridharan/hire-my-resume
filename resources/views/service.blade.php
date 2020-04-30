@extends('layout.main')

@section('content')
    <section class="p-t-45 p-b-50">
        <div class="container">
            <div class="row" style="display: flex; align-items: center" >
                <div class="col-sm-5">
                    @if(isset($post->image))
                        <img src="{{asset($post->image)}}" class="img-responsive" />
                    @endif
                </div>
                <div class="col-sm-7">
                    <h1 style="margin: 16px 0; color: #4bc3de">{{$post->title}}</h1>
                    {!!$post->body!!}
                    <a href="{{url('/resume')}}" class="site-btn" style="margin-top: 15px">Submit Request</a>
                </div>
            </div>
        </div>
    </section>
    <hr />
    <section class="p-t-45 p-b-50 text-center" style="background-color: #f5f5f5;">
        <h4>Have a question or any reservations? Contact us here at <a href="mailto:help@hiremyresume.com">help@hiremyresume.com</a></h4>
    </section>
@endsection