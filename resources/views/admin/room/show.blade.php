@extends('layouts.worker')

@section('title', "Data Ruangan" . $room->nomor_kamar)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center px-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Ruangan {{ $room->nomor_kamar }}</h6>
                <div class="row">
                    <a href="{{ route('rooms.edit', ['room' => $room->id]) }}" class="btn btn-success">Ubah
                        Data Ruangan</a>
                    <form action="{{ route('rooms.destroy', ['room' => $room->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-2" id="btn-hapus"
                            data-name="{{ $room->nomor_kamar }}">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @include('admin.room.form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
