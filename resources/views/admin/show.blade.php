@extends('layouts.worker')

@section('title', 'Profile ' . $admin->nama)

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between align-items-center px-3">
                <h6 class="m-0 font-weight-bold text-primary">Data admin {{ $admin->nama }}</h6>
                <div class="row">
                    @if (Auth::user()->admin->id == $admin->id)
                    <a href="{{ route('admins.edit', ['admin' => $admin->id]) }}" class="btn btn-success">Edit
                        Profile</a>
                    <form action="{{ route('admins.destroy', ['admin' => $admin->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger ml-2" id="btn-hapus"
                            data-name="{{ $admin->nama }}">Hapus</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="row">
                <div class="col-sm-4 text-left">
                    <img src="{{ asset('storage/uploads/image/' . (Auth::user()->admin->photo ?? $admin->photo)) }}"
                        alt="user photo" width="300" class="img-thumbnail">
                </div>
                <div class="col-sm-8">
                    @include('admin.form', ['button' => 'Update'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
