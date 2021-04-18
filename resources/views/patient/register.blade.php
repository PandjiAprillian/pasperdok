@extends('layouts.worker', ['page' => 'register'])

@section('title', 'Sign Up!')

@section('content')
<div class="container mt-5">
    <div class="card mb-3">
        <img class="card-img-top bg-register-image" height="350px">
        <div class="card-body">
            <h5 class="card-title text-center display-4">Register Akun</h5>
            <div class="row">
                <div class="col-sm-8">
                    <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
                        @include('patient.form', ['button' => 'Sign Up'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
