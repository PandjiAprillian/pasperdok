@extends('layouts.worker')

@section('title', 'Tambah Data')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penyakit Baru</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{ route('diseases.store') }}" method="post" enctype="multipart/form-data">
                                @include('admin.disease.form', ['button' => 'Tambah'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
