@extends('layouts.worker')

@section('title', "Data Penyakit {$disease->nama_penyakit}")

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center px-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Penyakit {{ $disease->nama_penyakit }}</h6>
                <div class="row">
                    <a href="{{ route('diseases.edit', ['disease' => $disease->id]) }}" class="btn btn-success">Ubah
                        Nama Penyakit</a>
                    <form action="{{ route('diseases.destroy', ['disease' => $disease->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-2" id="btn-hapus"
                            data-name="{{ $disease->nama_penyakit }}">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @include('admin.disease.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
