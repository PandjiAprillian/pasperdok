@extends('layouts.worker')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h3>Dashboard</h3>
        </div>
    </div>

    <div class="row justify-content-center mt-2">

        <div class="col-sm-12 d-flex justify-content-center">
            <!-- Jumlah Pasien -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Pasien</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <a href="{{ route('admins.data.patient') }}" class="text-dark"
                                        style="text-decoration: none">{{ $patientCount }} orang pasien</a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-procedures fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Perawat -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Jumlah Perawat</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <a href="{{ route('admins.data.nurse') }}" class="text-dark"
                                        style="text-decoration: none">
                                        {{ $nurseCount }} perawat
                                    </a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-nurse fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Dokter -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Dokter
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <a href="{{ route('admins.data.doctor') }}" class="text-dark"
                                                style="text-decoration: none">{{ $doctorCount }} dokter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-md fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 d-flex justify-content-center">
            <!-- Jumlah Data Penyakit -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Jumlah Data
                                    Penyakit
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <a href="{{ route('diseases.index') }}" class="text-dark"
                                                style="text-decoration: none">{{ $diseasesCount }} Penyakit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-viruses fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Data Ruangan -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Data
                                    Ruangan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <a href="{{ route('rooms.index') }}" class="text-dark"
                                                style="text-decoration: none">{{ $roomsCount }} Ruangan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-person-booth fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
