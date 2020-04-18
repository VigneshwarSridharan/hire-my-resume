@extends('voyager::master')

@section('page_title', 'Review')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-bubble"></i> Review
    </h1>
@endsection


@section('css')
    <link rel="stylesheet" href="{{url('/assets/vendor/rateit/rateit.css')}}" />
@endsection

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" id="rating-form">
                    @csrf
                    <div class="panel panel-bordered" style="padding-bottom:5px;">
                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">Ratings</h3>
                        </div>
                        <div class="panel-body" style="padding-top:0;">
                            @foreach ($ratings as $rating)
                                <div class="row">
                                    <div class="col-sm-3">
                                        <b>{{$rating['rating_name']}}</b>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="range" value="{{$rating['stars']}}" step="0.25" id="backing-{{$rating['id']}}" name="rating[{{$rating['id']}}]" required>
                                        <div 
                                            class="rateit" 
                                            data-rateit-backingfld="#backing-{{$rating['id']}}" 
                                            data-rateit-resetable="false" 
                                            data-rateit-ispreset="true" 
                                            data-rateit-step="1"
                                            data-rateit-min="0" 
                                            data-rateit-max="5"
                                        >
                                        </div>
                                        <textarea class="form-control" placeholder="Remark" name="remark[{{$rating['id']}}]">{{$rating['remark']}}</textarea>
                                    </div>
                                </div>
                                <hr style="margin-top:0" />
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{url('/assets/vendor/rateit/jquery.rateit.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.rateit').rateit();
        })
        $('#rating-form').on('submit', function(e) {
            e.preventDefault();
            data = $(this).serializeArray();
            if(data.filter(f => f.value == '0').length) {
                alert('Please fill all fields');
                return;
            }
            this.submit();
        })
    </script>
@endsection