
<header class="main-header" id="home">
    @if(Request::path() == '/')
        <video style="margin-bottom: -50%;position: relative;z-index: -1;" src="{{url('/assets/img/slider/1.mp4')}}" width="100%" autoplay loop ></video>
    @elseif(isset($pageImage))
        <div class="main-header-overlay" style="background-image: url({{asset($pageImage)}})"></div>
    @else
        <div class="main-header-overlay" style="background-image: url({{url('/assets/img/pricing-bg.jpg')}})"></div>
    @endif
    <div class="main-header__menu-line">
        <a href="{{url('/')}}" class="main-header__text-logo">
            <img src="{{asset(setting('site.logo'))}}" />
        </a>
        <div class="wpc-navigation">
            <nav class="clearfix">
                {{$menu}}
                {{-- <ul class="main-menu">
                    <li class="menu-item"><a href="#home">Home</a></li>
                    <li class="menu-item"><a href="./about-us.html">About Us</a></li>
                    <li class="menu-item"><a href="#advantages">Service</a></li>
                    <li class="menu-item"><a href="#testimonials">Testimonials</a></li>
                    <li class="menu-item"><a href="#pricing">Pricing</a></li>
                    <li class="menu-item"><a href="#blog-slide">Blog</a></li>
                    <li class="menu-item"><a href="#contact-us">Contact</a></li>
                </ul> --}}
                <div class="nav-menu-icon"><i></i></div>
            </nav>
        </div>
    </div>
    @if(Request::path() == '/')
        <div class="main-header__img-logo clearfix">
            {{-- <img src="{{url('/assets/img/Hiremyresume-logo.png')}}" alt="#" height="150"> --}}
        </div>
        <h2 class="main-header__text-top">HIREMYRESUME</h2>{{--Welcome to--}}
        <h2 class="main-header__text-middle">IMPROVE YOUR <br />CHANCES HERE</h2>
        <p class="main-header__text-bottom" style="color: #FFFBFB">Expert evaluation from actual recruiters</p>
        <div class="call-to-action">
            <a href="{{url('/quote')}}" class="call-to-action__link">DROP YOUR RESUME HERE</a>
        </div>
    @elseif(isset($pageTitle))
        <div class="page-wrapper  p-t-100 ">

            <div style="max-width: 80%; margin: 0 auto">

                <div class="card card-6">

                    

                    <div class="card-body" style="padding: 2% 5%">

                    <h1>{{$pageTitle}}</h1>

                    </div>

                    

                </div>

            </div>

        </div>
    @endif

    @yield('header-content')

</header>