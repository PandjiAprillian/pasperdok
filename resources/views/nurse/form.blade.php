@php
$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
'November', 'Desember'];
@endphp

@csrf

@if (request()->is("nurses/create") || request()->is("nurses/{$nurse->id}/edit"))
<div class="form-group row justify-content-center">
    <label for="nip" class="col-sm-6 col-form-label text-md-right">NIP</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nip" id="nip" placeholder="nip 16 Karakter"
            value="{{ old('nip') ?? $nurse->nip ?? '' }}">
        @error('nip')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="nama" class="col-sm-6 col-form-label text-md-right">Nama</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') ?? $nurse->nama ?? '' }}">
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
            value="{{ old('email') ?? $nurse->user->email ?? '' }}">
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
        <input type="password" class="form-control" name="password" id="password" placeholder="{{ $button == 'Tambah' ? "Input password" : "Input Password baru" }}">
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
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Ketik ulang password">
    </div>
</div>

@if ($button == 'create')
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
    <label for="alamat" class="col-sm-6 col-form-label text-md-right">Alamat</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="alamat" id="alamat"
            rows="3">{{ old('alamat') ?? $nurse->alamat ?? '' }}</textarea>
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
            value="{{ old('tgl') ?? $nurse->tgl ?? '' }}">
        <select name="bln" id="bln" class="custom-select col-md-5 d-inline" style="vertical-align: baseline">
            @foreach ($months as $key => $month)
            @if ($key + 1 == (old('bln') ?? $nurse->bln ?? ''))
            <option value="{{ $key + 1 }}" selected>{{ $month }}</option>
            @else
            <option value="{{ $key + 1 }}">{{ $month }}</option>
            @endif
            @endforeach
        </select>
        <input type="number" name="thn" id="thn" class="form-control col-md-3 d-inline" placeholder="yyyy"
            value="{{ old('thn') ?? $nurse->thn ?? '' }}">
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
                {{ (old('jenis_kelamin') ?? $nurse->jenis_kelamin ?? '') == 'L' ? 'checked' : '' }}>
            <label class="form-check-label" for="laki_laki">Laki - Laki</label>
        </div>
        <div class="form-check">
            <input class="form-check-input form-check-inline" type="radio" name="jenis_kelamin" id="perempuan" value="P"
                {{ (old('jenis_kelamin') ?? $nurse->jenis_kelamin ?? '') == 'P' ? 'checked' : '' }}>
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
            value="{{ old('handphone') ?? $nurse->handphone ?? '' }}">
        @error('handphone')
        <small class="form-text text-danger">
            <b>{{ $message }}</b>
        </small>
        @enderror
    </div>
</div>

@if (Auth::user()->hasRole('admin'))
<div class="form-group row">
    <label for="room_id"  class="col-sm-6 col-form-label text-md-right">Bertugas di kamar</label>
    <div class="col-sm-6">
        <select name="room_id" id="room_id" class="custom-select col-md-5 d-inline" style="vertical-align: baseline">
            @foreach ($rooms as $room)
            @if($room->id == 1)
            @continue
            @elseif ($room->id == (old('room_id') ?? $nurse->room_id ?? ''))
            <option value="{{ $room->id }}" selected>{{ $room->nomor_kamar }}</option>
            @else
            <option value="{{ $room->id }}">{{ $room->nomor_kamar }}</option>
            @endif
            @endforeach
        </select>
        @error('room_id')
            <small class="form-text text-danger">
                <strong>{{ $message }}</strong>
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
                onchange="$('#photo').val($(this).val())">{{ $nurse->photo ?? '...' }}</label>
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

@elseif (request()->is("nurses/{$nurse->id}"))
<div class="row mb-3">
    <div class="col">
        <label for="nik"><b>NIP</b></label>
        <p class="form-control-plaintext text-muted">{{ $nurse->nip }}</p>
    </div>
    <div class="col">
        <label for="nama"><b>Nama</b></label>
        <p class="form-control-plaintext text-muted">{{ $nurse->nama }}</p>
    </div>
    <div class="col">
        <label for="email"><b>Email</b></label>
        <p class="form-control-plaintext text-muted">{{ $nurse->user->email }}</p>
    </div>
</div>

<div class="row my-4">
    <div class="col">
        <label for="jenis_kelamin"><b>Jenis Kelamin</b></label>
        <p class="form-control-plaintext text-muted">{{ ($nurse->jenis_kelamin == 'L') ? 'Laki - Laki' : 'Perempuan' }}
        </p>
    </div>
    <div class="col">
        <label for="tanggal_lahir"><b>Tanggal Lahir</b></label>
        <p class="form-control-plaintext text-muted">{{ $nurse->tgl }} - {{ $nurse->bln }} - {{ $nurse->thn }}</p>
    </div>
    <div class="col">
        <label for="handphone"><b>No.Handphone</b></label>
        <p class="form-control-plaintext text-muted">{{ $nurse->handphone }}</p>
    </div>
</div>

<div class="row ">
    <div class="col">
        <label for="Alamat"><b>Alamat</b></label>
        <p class="form-control-plaintext text-muted">{{ $nurse->alamat }}</p>
    </div>
</div>
@endif
