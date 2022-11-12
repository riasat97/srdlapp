<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sheikh Russel Digital Lab</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{--    favicon--}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
{{--    favicon end--}}
{{--  <link href="assets/img/favicon.png" rel="icon">--}}
{{--  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">--}}

<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/jsmaps/jsmaps.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
            <h5><span><a href={{url('/')}}><img src="{{ asset('assets/img/srdl.png') }}" alt="" class="img-fluid"></a><a href={{url('/')}}>Sheikh Russel Digital Lab</a></span></h5>
            <!-- Uncomment below if you prefer to use an image logo -->
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="{{url('/')}}">Home</a></li>
                <li><a class="getstarted scrollto" href="{{url('/login')}}">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
<main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>About Us</h2>
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>@yield('breadcrumbs')</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs Section -->
    <!-- ======= Notice Section ======= -->
    <section id="notice" class="notice">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Notice</h2>
            </div>

            <div class="row content">
                @yield('content')
            </div>

        </div>
    </section><!-- End About Us Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 text-lg-left text-center">
                <div class="credits">
                    <div class="col-lg-12 col-md-4 col-6">
                        <img src="{{ asset('assets/img/srdl footer.png') }}" class="img-fluid" alt="" data-aos="zoom-in">
                    </div>
                    <div class="copyright">
                        &copy; Copyright <strong>SRDL PHASE-2 PROJECT</strong>. All Rights Reserved
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                    <a href="#intro" class="scrollto">Home</a>
                    <a href="#about" class="scrollto">About</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                </nav>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script type="text/javascript">

</script>
@stack('scripts')
</body>

</html>
