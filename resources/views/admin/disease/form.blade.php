@csrf

@if (request()->is("diseases/create") || request()->is("diseases/{$disease->id}/edit"))
<div class="form-group row">
    <label for="nama_penyakit" class="col-sm-6 col-form-label text-md-right">Nama Penyakit Baru</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nama_penyakit" id="nama_penyakit"
            value="{{ old('nama_penyakit') ?? $disease->nama_penyakit ?? '' }}">
        @error('nama_penyakit')
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

@elseif (request()->is("diseases/{$disease->id}"))
<div class="row">
    <div class="col">
        <label for="doctors"><b>Nama Penyakit</b></label>
        <ul class="list-group">
            <p class="list-group-item text-success font-weight-bold">{{ $disease->nama_penyakit }}</p>
        </ul>
    </div>
</div>

<div class="row mb-3">
    <div class="col-6">
        <label for="doctors"><b>Doktor Spesialist</b></label>
        <ul class="list-group">
            @if (count($disease->doctors) > 0)
            @foreach ($disease->doctors as $doctor)
            <a href="{{ route('doctors.show', ['doctor' => $doctor->id]) }}" class="list-group-item"
                style="text-decoration: none">{{ $doctor->nama }}</a>
            @endforeach
            @else
            <p class="text-muted">Tidak ada dokter spesialist yang terdaftar untuk
                <strong>{{ $disease->nama_penyakit }}</strong></p>
            @endif
        </ul>
    </div>
    <div class="col-6">
        <label for="patients"><b>Daftar Pasien</b></label>
        <ul class="list-group">
            @if (count($disease->patients) > 0)
            @foreach ($disease->patients as $patient)
            <a href="{{ route('admins.show.patient', ['patient' => $patient->id]) }}" class="list-group-item"
                style="text-decoration: none">{{ $patient->nama }}</a>
            @endforeach
            @else
            <p class="text-muted">Tidak ada Pasien yang terdaftar</p>
            @endif
        </ul>
    </div>
</div>
@endif
