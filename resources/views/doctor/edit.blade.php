@extends('layouts.worker')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit data Dokter {{ $doctor->nama }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{ route('doctors.update', ['doctor' => $doctor->id]) }}" method="post" enctype="multipart/form-data">
                                @method('PATCH')
                                @include('doctor.form', ['button' => 'Update'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
