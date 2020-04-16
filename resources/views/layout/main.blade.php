<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{setting('site.title')}}</title>
        <link rel="stylesheet" href="{{url('/assets/css/elegant-icons.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/normalize.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/boot.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/magnific-popup.css')}}">
        @if(Request::path() != "/")
            <link rel="stylesheet" href="{{url('/assets/css/main.css')}}">
        @endif
        <link rel="stylesheet" href="{{url('/assets/css/menu.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{url('/assets/css/app.css')}}">
        @yield('style')
    </head>

    <body>
        @include('layout.navigation')

        @yield('content')

        @include('layout.footer')
        {{-- <script data-cfasync="false" src="email-decode.min.js"></script> --}}
        <script src="{{url('/assets/js/jquery-2.2.4.min.js')}}"></script>
        <script src="{{url('/assets/js/jquery.countTo.js')}}"></script>
        <script src="{{url('/assets/js/idangerous.swiper.min.js')}}"></script>
        <script src="{{url('/assets/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{url('/assets/js/isotope.pkgd.min.js')}}"></script>
        <script src="{{url('/assets/js/jquery.matchHeight-min.js')}}"></script>
        <script src="{{url('/assets/js/script.js')}}"></script>
        @yield('script')
    </body>

</html>