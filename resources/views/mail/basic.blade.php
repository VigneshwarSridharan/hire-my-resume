@extends('mail.base')

@section('title', 'Welcome to '.setting('site.title').'!')

@section('content')
    <p>
        <b>Hey {{$name}},</b>
    </p>
    
    <p>
        {!!$msg!!}.
    </p>

    <p style="margin-top: 0">
        Regards,<br>
        {{setting('site.title')}} Team
    </p>
@endsection