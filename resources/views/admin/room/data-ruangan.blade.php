@extends('layouts.worker')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Ruangan</h6>
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary">Tambah Ruangan Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Nomor Ruangan</th>
                                    <th>Jumlah Pasien</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rooms as $room)
                                    <tr>
                                        <td>{{ $rooms->firstItem() + $loop->iteration - 1 }}</td>
                                        <td>{{ $room->nomor_kamar }}</td>
                                        <td>{{ $room->patients_count }} {{ $room->patients_count > 0 ? 'Orang' : '' }}</td>
                                        <td>
                                            <a href="{{ route('rooms.show', ['room' => $room->id]) }}" class="btn btn-info btn-circle btn-sm">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="mx-auto">
            {{ $rooms->links() }}
        </div>
    </div>

</div>
@endsection
