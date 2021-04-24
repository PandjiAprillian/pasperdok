@extends('layouts.worker')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Data Tabel Penyakit</h6>
                    <a href="{{ route('diseases.create') }}" class="btn btn-primary">Tambah Data Penyakit</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Nama Penyakit</th>
                                    <th>Dokter Spesialist</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($diseases as $disease)
                                <tr>
                                    <td>{{ $diseases->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $disease->nama_penyakit }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button"
                                                class="btn {{ (count($disease->doctors) > 0) ? 'btn-info' : 'btn-secondary' }} dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                {{ (count($disease->doctors) > 0) ? '' : 'disabled' }}>
                                                Dokter
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                @foreach ($disease->doctors as $doctor)
                                                <a class="dropdown-item"
                                                    href="{{ route('doctors.show', ['doctor' => $doctor->id]) }}">{{ $doctor->nama }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('diseases.show', ['disease' => $disease->id]) }}"
                                            class="btn btn-info btn-circle btn-sm">
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
            {{ $diseases->links() }}
        </div>
    </div>

</div>
@endsection
