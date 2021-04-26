@csrf

@if (request()->is("rooms/create") || request()->is("rooms/{$room->id}/edit"))
<div class="form-group row">
    <label for="nomor_kamar" class="col-sm-6 col-form-label text-md-right">Nama Ruangan Baru</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="nomor_kamar" id="nomor_kamar"
            value="{{ old('nomor_kamar') ?? $room->nomor_kamar ?? '' }}">
        @error('nomor_kamar')
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

@elseif (request()->is("rooms/{$room->id}"))
<div class="row">
    <div class="col">
        <label for="doctors"><b>Nomor Ruangan</b></label>
        <ul class="list-group">
            <p class="list-group-item text-success font-weight-bold">{{ $room->nomor_kamar }}</p>
        </ul>
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <label for="doctors"><b>Pasien Yang ada di ruangan ini</b></label>
        <ul class="list-group">
            @if (count($room->patients) > 0)
            @foreach ($room->patients as $patient)
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
