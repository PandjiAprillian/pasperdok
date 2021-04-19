@extends('layouts.user')

@section('title', 'Edit Profile')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4">
                <img src="..." alt="..." class="img-thumbnail">
            </div>

            <div class="col-sm-8">
                <form action="#" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @include('patient.form', ['button' => 'Update'])
                </form>
            </div>
        </div>
    </div>
@endsection
