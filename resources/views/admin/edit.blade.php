@extends('layouts.worker')

@section('title', 'Edit Admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Edit data admin {{ $admin->nama }}</h6>
                </div>
                <div class="card-body">
                    <div class="row justify-content-start">
                        <div class="col-sm-8">
                            <form action="{{ route('admins.update', ['admin' => $admin->id]) }}" method="post" enctype="multipart/form-data">
                                @method('PATCH')
                                @include('admin.form', ['button' => 'Update'])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
