@extends('layouts.worker')

@section('title', 'Data Perawat Baru')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center px-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline">Tambah Data Perawat Baru</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-start">
                        <form action="{{ route('nurses.store') }}" method="post" enctype="multipart/form-data">
                            @include('nurse.form', ['button' => 'Tambah'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
