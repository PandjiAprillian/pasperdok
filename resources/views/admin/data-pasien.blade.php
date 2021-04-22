@extends('layouts.worker')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Seluruh Pasien</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($patients as $patient)
                                    <tr>
                                        <td>{{ $patients->firstItem() + $loop->iteration - 1 }}</td>
                                        <td>{{ $patient->nik }}</td>
                                        <td>{{ $patient->nama }}</td>
                                        <td>{{ \Carbon\Carbon::create($patient->tanggal_lahir)->age }} tahun</td>
                                        <td>{{ $patient->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}</td>
                                        <td>
                                            <a href="{{ route('admins.show.patient', ['patient' => $patient->id]) }}" class="btn btn-info btn-circle btn-sm">
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
            {{ $patients->links() }}
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
