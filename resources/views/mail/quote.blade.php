@extends('mail.base')

@section('title', setting('site.title').'!')

@section('content')
    <p>
        <b>Hi,</b>
    </p>


    <table style="width: 100%">
        <tr>
            <td><b>Name:</b></td>
            <td>{{$name}}</td>
        </tr>
        <tr>
            <td><b>Email:</b></td>
            <td>{{$email}}</td>
        </tr>
        <tr>
            <td><b>Phone Number:</b></td>
            <td>{{$phone_number}}</td>
        </tr>
        <tr>
            <td><b>Experience:</b></td>
            <td>{{$experience}}</td>
        </tr>
        <tr>
            <td><b>Industry:</b></td>
            <td>{{$industry}}</td>
        </tr>
        <tr>
            <td><b>Service:</b></td>
            <td>{{$service}}</td>
        </tr>
        <tr>
            <td><b>Resume:</b></td>
            <td>
                @if(isset($resume))
                    <a href="{{$resume}}">Download</a>
                @else
                    N/A
                @endif
            </td>
        </tr>
    </table>
@endsection