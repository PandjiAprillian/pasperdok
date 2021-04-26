@extends('layouts.worker')

@section('title', 'Tambah Data Admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Admin Baru</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
                                @include('admin.form', ['button' => 'Tambah'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
