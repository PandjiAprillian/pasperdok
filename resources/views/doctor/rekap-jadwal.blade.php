@extends('layouts.worker')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Rekapitulasi Jam Kerja {{ $doctor->nama }}
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Total Bekerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                            <tr class="text-center">
                                <td>{{ $attendances->firstItem() + $loop->iteration - 1 }}</td>
                                <td>
                                    {{ \Carbon\Carbon::create($attendance->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </td>
                                <td>{{ $attendance->jam_masuk }}</td>
                                <td>{{ $attendance->jam_keluar == null ? '- -' : $attendance->jam_keluar }}</td>
                                <td>{{ $attendance->jam_kerja == null ? '- -' : $attendance->jam_kerja }}</td>
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

    <div class="row mt-5">
        <div class="mx-auto">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
@endsection
