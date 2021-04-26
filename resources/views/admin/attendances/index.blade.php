@extends('layouts.worker')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Rekapitulasi Jadwal karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Role</td>
                                    <td>Nama</td>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Total Bekerja</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendances->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>
                                        {{ ($attendance->attendanceable_type == 'App\Models\Doctor') ? 'Dokter' : 'Perawat' }}
                                    </td>
                                    <td>
                                        <a
                                            href="{{ ($attendance->attendanceable_type == 'App\Models\Doctor') ? route('doctors.show', ['doctor' => $attendance->attendanceable->id]) : route('nurses.show', ['nurse' => $attendance->attendanceable->id]) }}">
                                            {{ $attendance->attendanceable->nama }}
                                        </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </td>
                                    <td>{{ $attendance->jam_masuk }}</td>
                                    <td>{{ $attendance->jam_keluar }}</td>
                                    <td>{{ $attendance->jam_kerja }}</td>
                                    <td>
                                        <form
                                            action="{{ route('attendances.destroy', ['attendance' => $attendance->id]) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm icon-hapus"
                                                data-name="{{ $attendance->attendanceable->nama }}">
                                                Hapus
                                            </button>
                                        </form>
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
            {{ $attendances->links() }}
        </div>
    </div>

</div>
@endsection
