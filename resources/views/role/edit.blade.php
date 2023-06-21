@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Product</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('role.update', $role->id) }}" method="POST" class="my-4">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label">Nama Role</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ $role->name }}" autofocus>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            <!-- Tambahkan elemen form lainnya di sini -->
            <button type="submit" class="btn btn-primary offset-md-3">Submit</button>
            <a href="{{ route('role.index') }}" class="btn btn-danger mx-2">Cancel</a>
            </form>
        </div>
    </div>
</div>


@endsection
