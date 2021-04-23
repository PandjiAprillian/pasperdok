@extends('layouts.worker')

@section('title', 'Profile ' . $nurse->nama)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center px-3">
                <h6 class="m-0 font-weight-bold text-primary d-inline">Data perawat {{ $nurse->nama }}</h6>
                @if (Auth::user()->hasRole('nurse'))
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button disabled class="btn btn-info">Ruangan {{ $nurse->room->nomor_kamar }}</button>
                    <a href="{{ route('nurses.edit', ['nurse' => $nurse->id]) }}" class="btn btn-success">Edit
                        Profile</a>
                </div>
                @endif
                @if (Auth::user()->hasRole('admin'))
                <div class="btn-group" role="group">
                    <button disabled class="btn btn-info">Ruangan {{ $nurse->room->nomor_kamar }}</button>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a href="{{ route('nurses.edit', ['nurse' => $nurse->id]) }}"
                                class="dropdown-item text-success">Edit
                                Profile</a>

                            <form action="{{ route('nurses.destroy', ['nurse' => $nurse->id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="dropdown-item text-danger" id="btn-hapus"
                                    data-name="{{ $nurse->nama }}">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="row">
                <div class="col-sm-4 text-left">
                    <img src="{{ asset('storage/uploads/image/' . (Auth::user()->nurse->photo ?? $nurse->photo)) }}"
                        alt="user photo" width="300" class="img-thumbnail">
                </div>
                <div class="col-sm-8">
                    @include('nurse.form', ['button' => 'Update'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
