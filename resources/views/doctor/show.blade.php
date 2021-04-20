@extends('layouts.worker')

@section('title', 'Profile Dr. ' . $doctor->nama)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center px-3">
                Data Dr. {{ $doctor->nama }}
                <a href="{{ route('doctors.edit', ['doctor' => $doctor->id]) }}" class="btn btn-success">Edit
                    Profile</a>
            </div>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="row">
                <div class="col-sm-4 text-left">
                    <img src="{{ asset('storage/uploads/image/' . (Auth::user()->doctor->photo ?? $doctor->photo)) }}"
                        alt="user photo" width="300" class="img-thumbnail">
                </div>
                <div class="col-sm-8">
                    @include('doctor.form', ['button' => 'Update'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
