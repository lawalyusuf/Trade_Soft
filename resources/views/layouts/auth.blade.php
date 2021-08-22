<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield("title") | TradeSoft</title>
    <link href="{{ asset('soft/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('soft/assets/css/all.min.css')}}">
    <link href="{{ asset('css/app.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('soft/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <body>
        <header id="header" class="mt-4">
            <div class="container d-flex align-items-center">
                <h1 class="mr-auto"><a href="index.html" class="logo text-s">TradeSoft</a></h1>

                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">How it works</a></li>
                        <li><a href="faq.html">FAQs</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </nav>
                @if (auth()->user())
                    <a href="{{ route('dashboard') }}" class="btn-p-outline">Dashboard</a>
                @else
                    <a href="{{ route('user.login') }}" class="btn-p-outline">Join now</a>
                @endif
            </div>
        </header>
        <section id="subscribe" class="mt-5">
            @yield("content")
        </section>

        <footer class="bg-s">
            <div class="container">
                <div class="container py-5">
                    <h1 class="logo text-white text-center">TradeSoft</h1>
                </div>
                <div class="row p-0 m-0 pb-5">
                    <div class="col-md-4 p-0">
                        <div class="d-flex justify-content-md-around text-white">
                            <span class="fab fa-facebook-square text-footer"></span>
                            <span class="fab fa-instagram text-footer"></span>
                            <span class="fab fa-twitter text-footer"></span>
                            <span class="fab fa-linkedin-in text-footer"></span>
                            <h4 class="text-center text-white text-footer">(C) 2021</h4>
                        </div>
                    </div>
                    <div class="col-md-4 p-0">
                        <h4 class="text-center text-white text-footer">info@tradesoft.com</h4>
                    </div>
                    <div class="col-md-4 p-0">
                        <h4 class="text-center text-white text-footer">Terms & Conditions</h4>
                    </div>
                </div>
            </div>
        </footer>

        <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

        <script src="{{ asset('soft/assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/venobox/venobox.min.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('soft/assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('soft/assets/js/main.js') }}"></script>
    </body>
</html>
