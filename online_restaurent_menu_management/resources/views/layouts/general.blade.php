<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('meta')

        <title>Mamma's Kitchen | @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        @yield('stylesheets')

        <script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.flexslider.min.js') }}"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('.flexslider').flexslider({
                 animation: "slide",
                 controlsContainer: ".flexslider-container"
                });
            });
        </script>

        <link rel="icon" href="{{asset('images/icons/favicon.ico')}}" type="image/gif" sizes="16x16">

    </head>
    <body data-spy="scroll" data-target="#template-navbar">

        <!--== 4. Navigation ==-->
        <nav id="template-navbar" class="navbar navbar-default custom-navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#Food-fair-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img id="logo" src="{{asset('images/Logo_main.png')}}" class="logo img-responsive">
                    </a>
                </div>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="Food-fair-toggle">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">home</a></li> 
                        <li><a href="{{ url('/cart') }}" class="cart" onclick="showCart()" id="cart">
                                <span class="fa fa-shopping-cart"></span>
                                <span class="items-number" id="number-of-item">0</span>
                            </a>
                        </li>
                        @if (Route::has('login'))
                             
                                @auth
                                    <li> <a href="{{ url('/home') }}">Profile</a> </li>
                                @else
                                    <li> <a href="{{ route('login') }}">Login</a> </li>
                                    <li> <a href="{{ route('register') }}">Register</a> </li>                                   
                                @endauth
                             
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.row -->
        </nav>


        @yield('main-body')

        <section id="contact" class="contact">
            <div class="container-fluid color-bg">
                <div class="row dis-table">
                    <div class="hidden-xs col-sm-6 dis-table-cell">
                        <h2 class="section-title">Contact With us</h2>
                    </div>
                    <div class="col-xs-6 col-sm-6 dis-table-cell">
                        <div class="section-content">
                            <p>Shamima Akhter Shanta</p>
                            <p>Roll No. - 13205445</p>
                            <p>Department of Computer Science & Engineering</p>
                            <p>University of Rajshahi</p>
                            <p>shantacseru.13@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="social-media">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <ul class="center-block">
                                <li><a href="#" class="fb"></a></li>
                                <li><a href="#" class="twit"></a></li>
                                <li><a href="#" class="g-plus"></a></li>
                                <li><a href="#" class="link"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
 
        <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.mixitup.min.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.validate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.hoverdir.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jQuery.scrollSpeed.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
        @yield('script');

    </body>
</html>