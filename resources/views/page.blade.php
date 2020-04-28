@extends('layout.main')

@section('content')
    <section class="p-t-45 p-b-50">
        <div class="container">
            @if(isset($post->image))
                <img src="{{asset($post->image)}}" class="img-responsive" />
            @endif
            {!!$post->body!!}
            <div class="mt-5" id="disqus_thread"></div>
        </div>
    </section>
@endsection