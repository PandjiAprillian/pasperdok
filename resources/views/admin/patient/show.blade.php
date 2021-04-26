@extends('layouts.worker')

@section('title', 'Detail Profile')

@section('content')
<div class="container" style="margin-top: 50px">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center px-3">
                        Data pasien {{ $patient->nama }}
                        <div class="row">
                            <a href="{{ route('admins.edit.patient', ['patient' => $patient->id]) }}"
                                class="btn btn-success mr-2">Edit Profile</a>
                            <form action="{{ route('admins.destroy.patient', ['patient' => $patient->id]) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" id="btn-hapus"
                                    data-name="{{ $patient->nama }}">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="row">
                        <div class="col-sm-4 text-left">
                            <img src="{{ asset('storage/uploads/image/' . (Auth::user()->patient->photo ?? $patient->photo)) }}"
                                alt="user photo" width="300" class="img-thumbnail">
                        </div>
                        <div class="col-sm-8">
                            @include('admin.patient.form', ['button' => 'Update'])
                        </div>
                    </div>
                </div>
                @if (Auth::user()->hasRole('doctor') || Auth::user()->hasRole('admin'))
                <div class="card-footer text-muted">
                    <fieldset
                        {{ ($patient->rawat_inap == 1 || $patient->rawat_inap == 2) ? 'disabled="disabled"' : '' }}>
                        <div class="row align-items-center justify-content-center">
                            <div class="col">
                                <div class="form-group row align-items-center">
                                    <label for="rawat_inap"
                                        class="col-sm-3 col-form-label text-md-right">Perawatan</label>
                                    <div class="col-sm-5">
                                        <select class="form-control form-control-sm" name="rawat_inap" id="rawat_inap">
                                            @if ($patient->rawat_inap == 1 || $patient->rawat_inap == 2)
                                            <option value="{{ $patient->rawat_inap }}">
                                                {{ $patient->rawat_inap == 1 ? 'Rawat Inap' : 'Rawat Jalan' }}
                                            </option>
                                            @else
                                            <option value="1">Rawat Inap</option>
                                            <option value="2">Rawat Jalan</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div
                                    class="form-group row align-items-center justify-content-end {{ $patient->rawat_inap == 2 ? 'd-none' : '' }}">
                                    <label for="no_kamar" class="col-sm-3 col-form-label text-md-right">No.Kamar</label>
                                    <div class="col-sm-5">
                                        <select class="form-control form-control-sm" name="room_id" id="no_kamar">
                                            @foreach ($rooms as $room)
                                            @if ($room->patients_count == 2)
                                            @continue
                                            @elseif ($patient->rawat_inap == 1)
                                            <option value="{{ $patient->room->id }}" selected>
                                                {{ $patient->room->nomor_kamar }}
                                            </option>
                                            @else
                                            <option value="{{ $room->id }}">{{ $room->nomor_kamar }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
