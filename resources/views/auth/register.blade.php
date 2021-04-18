@extends('layouts.worker', ['page' => 'register'])

@section('title', 'Sign Up!')

@section('content')
<div class="container" style="margin-top: 100px" id="register">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-5 align-self-center">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Sign Up!</h1>
                        </div>

                        <form class="user" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nama"
                                    class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama"
                                    value="{{ old('nama') }}" placeholder="Inputkan nama anda">
                                @error('nama')
                                <small class="form-text text-danger">
                                    <b>{{ $message }}</b>
                                </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" name="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" id="email" placeholder="Inputkan email anda">
                                @error('nama')
                                <small class="form-text text-danger">
                                    <b>{{ $message }}</b>
                                </small>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="password" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-user" id="password_confirmation"
                                        placeholder="Ulangi Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Sign Up</button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Sudah punya akun? Login!</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
