@extends('layouts.worker')

@section('title', 'Doctor Page')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="h2">Daftar Pasien Anda</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center px-3">
                        oke
                        @if ($attendanceDate)
                        <form action="{{ route('attendances.out') }}" method="post">
                            @csrf
                            <button id="btn-keluar" type="submit" class="btn btn-success">
                                Absen Keluar
                            </button>
                        </form>
                        @else
                        <form action="{{ route('attendances.store') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                Absen masuk
                            </button>
                        </form>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Handphone</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patients as $patient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $patient->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }} Tahun</td>
                                    <td>{{ ($patient->jenis_kelamin == 'L') ? 'Laki - Laki' : 'Perempuan' }}</td>
                                    <td>{{ $patient->handphone }}</td>
                                    <td>
                                        <a href="{{ route('patients.show', ['patient' => $patient->id]) }}" class="btn btn-sm btn-warning">Detail Pasien</a>
                                    </td>
                                </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="6">Tidak ada pasien</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto mt-3">
            {{ $diseases->links() }}
        </div>
    </div>
</div>
@endsection
