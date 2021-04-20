@php
$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
'November', 'Desember'];
@endphp

@csrf

@if (request()->is("register") || request()->is("patients/{$patient->id}/edit"))
<div class="form-group row justify-content-center">
    <label for="nik" class="col-sm-6 col-form-label text-md-right">NIK</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK 16 Karakter"
            value="{{ old('nik') ?? $patient->nik ?? '' }}">
        @error('nik')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="nama" class="col-sm-6 col-form-label text-md-right">Nama</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') ?? $patient->nama ?? '' }}">
        @error('nama')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-sm-6 col-form-label text-md-right">Email</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="email" id="email"
            value="{{ old('email') ?? $patient->user->email ?? '' }}">
        @error('email')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

@if ($button == 'Sign Up')
<div class="form-group row">
    <label for="password" class="col-sm-6 col-form-label text-md-right">password</label>
    <div class="col-sm-6">
        <input type="password" class="form-control" name="password" id="password">
        @error('password')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password_confirmation" class="col-sm-6 col-form-label text-md-right">Konfirmasi Password</label>
    <div class="col-sm-6">
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
    </div>
</div>
@endif

<div class="form-group row">
    <label for="tanggal_lahir" class="col-sm-6 col-form-label text-md-right">Tanggal Lahir</label>
    <div class="col-sm-6">
        <input type="number" name="tgl" id="tgl" class="form-control col-md-3 d-inline" placeholder="dd"
            value="{{ old('tgl') ?? $patient->tgl ?? '' }}">
        <select name="bln" id="bln" class="custom-select col-md-4 d-inline" style="vertical-align: baseline">
            @foreach ($months as $key => $month)
            @if ($key + 1 == (old('bln') ?? $patient->bln ?? ''))
            <option value="{{ $key + 1 }}" selected>{{ $month }}</option>
            @else
            <option value="{{ $key + 1 }}">{{ $month }}</option>
            @endif
            @endforeach
        </select>
        <input type="number" name="thn" id="thn" class="form-control col-md-3 d-inline" placeholder="yyyy"
            value="{{ old('thn') ?? $patient->thn ?? '' }}">
        @error('tanggal_lahir')
        <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="alamat" class="col-sm-6 col-form-label text-md-right">Alamat</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="alamat" id="alamat"
            rows="3">{{ old('alamat') ?? $patient->alamat ?? '' }}</textarea>
        @error('alamat')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="jenis_kelamin" class="col-sm-6 col-form-label text-md-right">Jenis Kelamin </label>
    <div class="col-sm-6">
        <div class="form-check">
            <input class="form-check-input form-check-inline" type="radio" name="jenis_kelamin" id="laki_laki" value="L"
                {{ (old('jenis_kelamin') ?? $patient->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }}>
            <label class="form-check-label" for="laki_laki">Laki - Laki</label>
        </div>
        <div class="form-check">
            <input class="form-check-input form-check-inline" type="radio" name="jenis_kelamin" id="perempuan" value="P"
                {{ (old('jenis_kelamin') ?? $patient->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }}>
            <label class="form-check-label" for="perempuan">Perempuan</label>
        </div>
        @error('jenis_kelamin')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="handphone" class="col-sm-6 col-form-label text-md-right">handphone</label>
    <div class="col-sm-6">
        <input type="number" class="form-control" name="handphone" id="handphone"
            value="{{ old('handphone') ?? $patient->handphone ?? '' }}">
        @error('handphone')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="photo" class="col-sm-6 col-form-label text-md-right">Pilih Foto</label>
    <div class="col-md-6">
        <div class="custom-file">
            <input type="file" name="photo" id="photo" accept="image/*" class="custom-file-input">
            <label for="photo" class="custom-file-label col-md-12"
                onchange="$('#photo').val($(this).val())">{{ $user->photo ?? '...' }}</label>
            @error('photo')
            <small class="form-text text-danger">
                <b>{{ $message }}</b>
            </small>
            @enderror
        </div>
    </div>
</div>

<div class="form-group row">
    <label for="penyakit" class="col-sm-6 col-form-label text-md-right">Penyakit Yang Di Derita</label>
    <div class="col-sm-6">
        <select multiple class="custom-select" name="diseases[]" id="penyakit">
            @foreach ($diseases as $disease)
            <option value="{{ $disease->id }}"
                {{ in_array($disease->id, (old('diseases') ?? $diseasesTaken ?? [])) ? 'selected' : '' }}>
                {{ $disease->nama_penyakit }}</option>
            @endforeach
        </select>
        <small>Tekan <kbd>CTRL</kbd> + Klik untuk memilih lebih</small>
    </div>
</div>

<div class="form-group row">
    <label for="keluhan" class="col-sm-6 col-form-label text-md-right">Keluhan</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="keluhan" id="keluhan"
            rows="3">{{ old('keluhan') ?? $patient->keluhan ?? '' }}</textarea>
        @error('keluhan')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col offset-sm-6">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
        </div>
    </div>
</div>
@elseif (request()->is("patients/{$patient->id}"))
<div class="row mb-3">
    <div class="col">
        <label for="nik"><b>NIK</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->nik }}</p>
    </div>
    <div class="col">
        <label for="nama"><b>Nama</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->nama }}</p>
    </div>
    <div class="col">
        <label for="email"><b>Email</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->user->email }}</p>
    </div>
</div>

<div class="row my-4">
    <div class="col">
        <label for="Alamat"><b>Alamat</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->alamat }}</p>
    </div>
    <div class="col">
        <label for="tanggal_lahir"><b>Tanggal Lahir</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->tgl }} - {{ $patient->bln }} - {{ $patient->thn }}</p>
    </div>
    <div class="col">
        <label for="jenis_kelamin"><b>Jenis Kelamin</b></label>
        <p class="form-control-plaintext text-muted">{{ ($patient->jenis_kelamin == 'L') ? 'Laki - Laki' : 'Perempuan' }}</p>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="penyakit"><b>Menderita</b></label>
        <ul class="list-group list-group-flush">
            @if ((str_replace(url('/'), '', url()->previous()) == '/doctors'))
                @foreach ($spesialists as $spesialistPenyakit)
                <p class="form-control-plaintext text-muted"><i>{{ $spesialistPenyakit }}</i></p>
                @endforeach
            @else
                @foreach ($diseasesTaken as $disease)
                    <p class="form-control-plaintext text-muted"><i>{{ $disease->nama_penyakit }}</i></p>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="col">
        <label for="handphone"><b>No.Handphone</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->handphone }}</p>
    </div>
    <div class="col">
        <label for="keluhan"><b>Keluhan</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->keluhan }}</p>
    </div>
</div>

@if (Auth::user()->hasRole('patient') || Auth::user()->hasRole('admin'))
<div class="row mt-3 justify-content-between">
    <div class="col">
        <label for="rawat_inap"><b>Rawat Inap?</b></label>
        @if ($patient->rawat_inap == 1)
        <p class="form-control-plaintext text-muted">Anda harus menjalani rawat inap</p>
        @elseif ($patient->rawat_inap == 2)
        <p class="form-control-plaintext text-muted">Anda hanya rawat jalan</p>
        @else
        <p class="form-control-plaintext text-muted">Dokter belum memutuskan</p>
        @endif
    </div>
    @if ($patient->rawat_inap == 1)
    <div class="col offset-sm-2">
        <label for="keluhan"><b>Anda Terdaftar di kamar</b></label>
        <p class="form-control-plaintext text-muted">{{ $patient->room->nomor_kamar }}</p>
    </div>
    @endif
</div>
@endif
@endif
