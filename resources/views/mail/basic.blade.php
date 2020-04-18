@extends('mail.base')

@section('title', 'Welcome to '.setting('site.title').'!')

@section('content')
    <p>
        <b>Hey {{$name}},</b>
    </p>

    <h2 style="text-align: center">Your Score: {{round($average*4*5)}}/100</h2>

    @foreach ($ratings as $rating )
        <table border="0" style="width: 100%">
            <tr>
                <td>
                    <p style="margin-bottom: 0"><b>{{$rating['rating_name']}}</b></p>
                </td>
                <td style="text-align: right">
                    <b>{{$rating['stars']*4}}/20</b>
                    @for ($i = 1; $i <= 5; $i++)
                        @if($i <= $rating['stars'])
                            <img src="{{url('/assets/img/star-gold.png')}}" />
                        @else
                            <img src="{{url('/assets/img/star-silver.png')}}" />
                        @endif
                    @endfor
                </td>
            </tr>
        </table>
        
        <div style="border: solid 1px #cccccc; padding: 10px">
            {{$rating['remark']}}
        </div>
    @endforeach
    
    <p>
        {!!$msg!!}.
    </p>

    <p style="margin-top: 0">
        Regards,<br>
        {{setting('site.title')}} Team
    </p>
@endsection