@extends('layouts.user')

@section('content')
<!-- ======= Hero Section ======= -->
@include('templates.patient.hero')
<!-- End Hero -->

<main id="main">

    <!-- ======= Why Us Section ======= -->
    @include('templates.patient.why-us')
    <!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    @include('templates.patient.about')
    <!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    @include('templates.patient.count')
    <!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    @include('templates.patient.service')
    <!-- End Services Section -->

    <!-- ======= Departments Section ======= -->
    @include('templates.patient.departement')
    <!-- End Departments Section -->

    <!-- ======= Doctors Section ======= -->
    @include('templates.patient.doctor')
    <!-- End Doctors Section -->

    <!-- ======= Contact Section ======= -->
    @include('templates.patient.contact')
    <!-- End Contact Section -->

</main>
<!-- End #main -->
@endsection
