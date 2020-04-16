@extends('layout.main')

@section('content')
    <section class="p-t-45 p-b-50">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog) 
                    <div class="col-md-6 no-padd">

                        <div class="post-preview clearfix">
                            <a href="{{url('blog',$blog->slug)}}" class="post-preview__pic">
                                <img src="{{asset($blog->image)}}" alt="post1" class="post-preview__pic">
                            </a>

                            <div class="post-preview__text">

                                <p class="post-preview__date"><span class="post-preview__date--big">{{$blog->created_at->format('d')}}</span>/ {{$blog->created_at->format('M')}}</p>

                                <a href="{{url('blog',$blog->slug)}}">
                                    <p class="post-preview__title">{{$blog->title}}</p>
                                </a>

                                <a href="{{url('blog',$blog->slug)}}" class="post-preview__more">continue</a>

                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection