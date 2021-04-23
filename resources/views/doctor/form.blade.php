@php
$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
'November', 'Desember'];
@endphp

@csrf

@if (request()->is("doctors/create") || request()->is("doctors/{$doctor->id}/edit"))
<div class="form-group row">
    <label for="nid" class="col-sm-6 col-form-label text-md-right">NID</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nid" id="nid" placeholder="nid 16 Karakter"
            value="{{ old('nid') ?? $doctor->nid ?? '' }}">
        @error('nid')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="nama" class="col-sm-6 col-form-label text-md-right">Nama</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') ?? $doctor->nama ?? '' }}">
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
            value="{{ old('email') ?? $doctor->user->email ?? '' }}">
        @error('email')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

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

<div class="form-group row">
    <label for="alamat" class="col-sm-6 col-form-label text-md-right">Alamat</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="alamat" id="alamat"
            rows="3">{{ old('alamat') ?? $doctor->alamat ?? '' }}</textarea>
        @error('alamat')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="tanggal_lahir" class="col-sm-6 col-form-label text-md-right">Tanggal Lahir</label>
    <div class="col-sm-6">
        <input type="number" name="tgl" id="tgl" class="form-control col-md-3 d-inline" placeholder="dd"
            value="{{ old('tgl') ?? $doctor->tgl ?? '' }}">
        <select name="bln" id="bln" class="custom-select col-md-5 d-inline" style="vertical-align: baseline">
            @foreach ($months as $key => $month)
            @if ($key + 1 == (old('bln') ?? $doctor->bln ?? ''))
            <option value="{{ $key + 1 }}" selected>{{ $month }}</option>
            @else
            <option value="{{ $key + 1 }}">{{ $month }}</option>
            @endif
            @endforeach
        </select>
        <input type="number" name="thn" id="thn" class="form-control col-md-3 d-inline" placeholder="yyyy"
            value="{{ old('thn') ?? $doctor->thn ?? '' }}">
        @error('tanggal_lahir')
        <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="jenis_kelamin" class="col-sm-6 col-form-label text-md-right">Jenis Kelamin </label>
    <div class="col-sm-6">
        <div class="form-check">
            <input class="form-check-input form-check-inline" type="radio" name="jenis_kelamin" id="laki_laki" value="L"
                {{ (old('jenis_kelamin') ?? $doctor->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }}>
            <label class="form-check-label" for="laki_laki">Laki - Laki</label>
        </div>
        <div class="form-check">
            <input class="form-check-input form-check-inline" type="radio" name="jenis_kelamin" id="perempuan" value="P"
                {{ (old('jenis_kelamin') ?? $doctor->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }}>
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
        <input type="text" class="form-control" name="handphone" id="handphone"
            value="{{ old('handphone') ?? $doctor->handphone ?? '' }}">
        @error('handphone')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

@if (Auth::user()->hasRole('admin'))
<div class="form-group row">
    <label for="disease_id" class="col-sm-6 col-form-label text-md-right">Spesialist Penyakit</label>
    <div class="col-sm-6">
        <select name="disease_id" id="disease_id" class="form-control">
            @foreach ($diseases as $disease)
            <option value="{{ $disease->id }}"
                {{ $disease->id == (old('disease_id') ?? $doctor->disease_id ?? '') ? 'selected' : '' }}>
                {{ $disease->nama_penyakit }}</option>
            @endforeach
        </select>
        @error('spesialist')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>
@endif

<div class="form-group row">
    <label for="photo" class="col-sm-6 col-form-label text-md-right">Pilih Foto</label>
    <div class="col-md-6">
        <div class="custom-file">
            <input type="file" name="photo" id="photo" accept="image/*" class="custom-file-input">
            <label for="photo" class="custom-file-label col-md-12"
                onchange="$('#photo').val($(this).val())">{{ $doctor->photo ?? '...' }}</label>
            @error('photo')
            <small class="form-text text-danger">
                <b>{{ $message }}</b>
            </small>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col offset-sm-6">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
        </div>
    </div>
</div>

@elseif (request()->is("doctors/{$doctor->id}"))
<div class="row mb-3">
    <div class="col">
        <label for="nik"><b>NID</b></label>
        <p class="form-control-plaintext text-muted">{{ $doctor->nid }}</p>
    </div>
    <div class="col">
        <label for="nama"><b>Nama</b></label>
        <p class="form-control-plaintext text-muted">{{ $doctor->nama }}</p>
    </div>
    <div class="col">
        <label for="email"><b>Email</b></label>
        <p class="form-control-plaintext text-muted">{{ $doctor->user->email }}</p>
    </div>
</div>

<div class="row my-4">
    <div class="col">
        <label for="jenis_kelamin"><b>Jenis Kelamin</b></label>
        <p class="form-control-plaintext text-muted">{{ ($doctor->jenis_kelamin == 'L') ? 'Laki - Laki' : 'Perempuan' }}
        </p>
    </div>
    <div class="col">
        <label for="tanggal_lahir"><b>Tanggal Lahir</b></label>
        <p class="form-control-plaintext text-muted">{{ $doctor->tgl }} - {{ $doctor->bln }} - {{ $doctor->thn }}</p>
    </div>
    <div class="col">
        <label for="handphone"><b>No.Handphone</b></label>
        <p class="form-control-plaintext text-muted">{{ $doctor->handphone }}</p>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="Alamat"><b>Alamat</b></label>
        <p class="form-control-plaintext text-muted">{{ $doctor->alamat }}</p>
    </div>
    <div class="col">
        <label for="penyakit"><b>Spesialist</b></label>
        <ul class="list-group list-group-flush">
            {{-- @foreach ($spesialists as $spesialist)
            <p class="form-control-plaintext text-muted"><i>{{ $spesialist->nama_penyakit }}</i></p>
            @endforeach --}}
            <p class="form-control-plaintext text-muted"><i>{{ $spesialist->nama_penyakit }}</i></p>
        </ul>
    </div>
</div>
@endif
