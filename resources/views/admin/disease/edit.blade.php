@extends('layouts.worker')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit data penyakit {{ $disease->nama_penyakit }}</h6>
                </div>
                <div class="card-body">
                    <div class="row justify-content-start">
                        <div class="col-sm-8">
                            <form action="{{ route('diseases.update', ['disease' => $disease->id]) }}" method="post" enctype="multipart/form-data">
                                @method('PATCH')
                                @include('admin.disease.form', ['button' => 'Update'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
