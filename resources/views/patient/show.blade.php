@extends('layouts.user')

@section('title', 'Edit Profile')

@section('content')
<div class="container" style="margin-top: 180px">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center px-3">
                        Data pasien {{ $patient->nama }}
                        <a href="{{ route('patients.edit', ['patient' => $patient->id]) }}" class="btn btn-success">Edit Profile</a>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="row">
                        <div class="col-sm-4 text-left">
                            <img src="{{ asset('storage/uploads/image/' . Auth::user()->patient->photo) }}" alt="user photo"
                                width="300" class="img-thumbnail">
                        </div>
                        <div class="col-sm-8">
                            @include('patient.form', ['button' => 'Update'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
