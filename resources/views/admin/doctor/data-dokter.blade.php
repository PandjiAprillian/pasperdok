@extends('layouts.worker')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Data Seluruh Dokter</h6>
                    <a href="{{ route('doctors.create') }}" class="btn btn-primary">Tambah Dokter</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>NID</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Email</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctors->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $doctor->nid }}</td>
                                    <td>{{ $doctor->nama }}</td>
                                    <td>{{ \Carbon\Carbon::create($doctor->tanggal_lahir)->age }} Tahun</td>
                                    <td>{{ $doctor->user->email }}</td>
                                    {{-- <td>{{ $doctor->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}</td> --}}
                                    {{-- <td>
                                        <div>
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn btn-warning btn-sm dropdown-toggle text-dark" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Spesialist Penyakit
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                @foreach ($doctor->diseases as $disease)
                                                    <a href="#" class="dropdown-item">{{ $disease->nama_penyakit }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('doctors.show', ['doctor' => $doctor->id]) }}" class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="7">Tidak ada data</td>
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
            {{ $doctors->links() }}
        </div>
    </div>

</div>
@endsection
