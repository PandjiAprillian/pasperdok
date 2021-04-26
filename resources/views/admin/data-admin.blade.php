@extends('layouts.worker')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Data Seluruh Admin</h6>
                    <a href="{{ route('admins.create') }}" class="btn btn-primary">Tambah Admin</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <th>Nama</th>
                                    <th>Handphone</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admins as $admin)
                                <tr>
                                    <td>{{ $admins->firstItem() + $loop->iteration - 1 }}</td>
                                    <td>{{ $admin->nama }}</td>
                                    <td>{{ $admin->handphone }}</td>
                                    <td>
                                        <a href="{{ route('admins.show', ['admin' => $admin->id]) }}"
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
            {{ $admins->links() }}
        </div>
    </div>

</div>
@endsection
