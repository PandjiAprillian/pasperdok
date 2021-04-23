@extends('layouts.worker')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Data Seluruh Perawat</h6>
                    <a href="{{ route('nurses.create') }}" class="btn btn-primary">Tambah Perawat</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Bertugas Di</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nurses as $nurse)
                                <tr>
                                    <td>{{ $nurses->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $nurse->nip }}</td>
                                    <td>{{ $nurse->nama }}</td>
                                    <td>{{ $nurse->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}</td>
                                    <td>Kamar : {{ $nurse->room->nomor_kamar }}</td>
                                    <td>
                                        <a href="{{ route('nurses.show', ['nurse' => $nurse->id]) }}"
                                            class="btn btn-info btn-circle btn-sm">
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
            {{ $nurses->links() }}
        </div>
    </div>

</div>
@endsection
