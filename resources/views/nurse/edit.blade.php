@extends('layouts.worker')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Edit data Dokter {{ $nurse->nama }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{ route('nurses.update', ['nurse' => $nurse->id]) }}" method="post" enctype="multipart/form-data">
                                @method('PATCH')
                                @include('nurse.form', ['button' => 'Update'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
