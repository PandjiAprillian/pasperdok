@extends('layouts.worker')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center px-3">
                        Bertugas di kamar : {{ Auth::user()->nurse->room->nomor_kamar }}
                        <a href="#" class="btn btn-primary">
                            Absen masuk
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-text">Data pasien yang ada di kamar {{ Auth::user()->nurse->room->nomor_kamar }}
                    </h6>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Jenis kelamin</th>
                                <th>Keluhan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patients as $patient)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $patient->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }}</td>
                                <td>
                                    {{ $patient->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}
                                </td>
                                <td>{{ $patient->keluhan }}</td>
                                <td>
                                    <a href="{{ route('patients.show', ['patient' => $patient->id]) }}" class="btn btn-sm btn-warning">Detail Pasien</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Ruangan kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
