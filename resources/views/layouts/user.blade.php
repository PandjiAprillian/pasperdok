<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" href="{{ asset('img/apple-icon-180x180.png') }}">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/vendor/patient/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/patient/icofont/icofont.min.css" rel="stylesheet">
    <link href="/vendor/patient/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/vendor/patient/venobox/venobox.css" rel="stylesheet">
    <link href="/vendor/patient/animate.css/animate.min.css" rel="stylesheet">
    <link href="/vendor/patient/remixicon/remixicon.css" rel="stylesheet">
    <link href="/vendor/patient/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/vendor/patient/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Top Bar && Header ======= -->
    @include('templates.patient.topbar')
    <!-- End Header -->

    @yield('content')

    <!-- ======= Footer ======= -->
    @include('templates.patient.footer')
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="/vendor/patient/jquery/jquery.min.js"></script>
    <script src="/vendor/patient/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/patient/jquery.easing/jquery.easing.min.js"></script>
    <script src="/vendor/patient/php-email-form/validate.js"></script>
    <script src="/vendor/patient/venobox/venobox.min.js"></script>
    <script src="/vendor/patient/waypoints/jquery.waypoints.min.js"></script>
    <script src="/vendor/patient/counterup/counterup.min.js"></script>
    <script src="/vendor/patient/owl.carousel/owl.carousel.min.js"></script>
    <script src="/vendor/patient/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Template Main JS File -->
    <script src="/js/main.js"></script>

</body>

</html>
