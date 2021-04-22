@extends('layouts.worker')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center px-3">
                        Bertugas di kamar : {{ Auth::user()->nurse->room->nomor_kamar }}
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
                    <h6 class="card-text">Data pasien yang ada di kamar {{ Auth::user()->nurse->room->nomor_kamar }}
                    </h6>
                    <div class="table-responsive-sm">
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
                                    <td>{{ $patients->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $patient->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($patient->tanggal_lahir)->age }}</td>
                                    <td>
                                        {{ $patient->jenis_kelamin == 'L' ? 'Laki - Laki' : 'Perempuan' }}
                                    </td>
                                    <td>{{ $patient->keluhan }}</td>
                                    <td>
                                        <a href="{{ route('patients.show', ['patient' => $patient->id]) }}"
                                            class="btn btn-sm btn-warning">Detail Pasien</a>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
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
</div>
@endsection
