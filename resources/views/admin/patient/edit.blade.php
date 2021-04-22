@extends('layouts.worker')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit data pasien {{ $patient->nama }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{ route('patients.update', ['patient' => $patient->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @include('patient.form', ['button' => 'Update'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
