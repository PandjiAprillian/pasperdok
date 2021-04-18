@csrf

@if ($button == 'Sign Up')
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
@else
<input type="hidden" class="form-control" name="nik" value="{{ $patient->nik }}">
@endif

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
    <label for="tanggal_lahir" class="col-sm-6 col-form-label text-md-right">Tanggal Lahir</label>
    <div class="col-sm-6">
        <input type="number" name="tgl" id="tgl" class="form-control col-md-3 d-inline @error('email') is-invalid @enderror" placeholder="dd"
            value="{{ old('tgl') ?? $user->tgl ?? '' }}">
        @php
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
        'November', 'Desember'];
        @endphp
        <select name="bln" id="bln" class="custom-select col-md-4 d-inline @error('email') is-invalid @enderror" style="vertical-align: baseline">
            @foreach ($months as $key => $month)
            @if ($key + 1 == (old('bln') ?? $user->bln ?? ''))
            <option value="{{ $key + 1 }}" selected>{{ $month }}</option>
            @else
            <option value="{{ $key + 1 }}">{{ $month }}</option>
            @endif
            @endforeach
        </select>
        <input type="number" name="thn" id="thn" class="form-control col-md-3 d-inline @error('email') is-invalid @enderror" placeholder="yyyy"
            value="{{ old('thn') ?? $user->thn ?? '' }}">
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
        <div class="col offset-6">
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
        </div>
    </div>
</div>
