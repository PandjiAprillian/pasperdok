@extends('layouts.worker', ['page' => 'login'])

@section('title', 'Login')

@section('content')
<div class="container" style="margin-top: 100px" id="login">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Silahkan Login!</h1>
                                </div>

                                <form class="user" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            id="email" value="{{ old('email') }}" placeholder="Inputkan email anda...">
                                        @error('email')
                                        <small class="form-text text-danger">
                                            <b>{{ $message }}</b>
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="password" placeholder="Password">
                                        @error('password')
                                        <small class="form-text text-danger">
                                            <b>{{ $message }}</b>
                                        </small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    <hr>
                                </form>

                                <div class="text-center">
                                    <small class="text-mute">Or</small>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">Buat akun baru!</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
