@extends('layouts.worker')

@section('title', 'Edit Ruangan')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit data Ruangan {{ $room->nomor_kamar }}</h6>
                </div>
                <div class="card-body">
                    <div class="row justify-content-start">
                        <div class="col-sm-8">
                            <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="post">
                                @method('PATCH')
                                @include('admin.room.form', ['button' => 'Update'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
