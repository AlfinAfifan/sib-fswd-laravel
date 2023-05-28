@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row">
      <div class="col ">
        <form action="{{ route('role.update', $role->id) }}" method="POST" class="my-5">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="inputName" class="col-sm-3 col-form-label">Nama Role</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="inputName" name="name" value="{{ $role->name }}">
                </div>
            </div>
          <!-- Tambahkan elemen form lainnya di sini -->
          <button type="submit" class="btn btn-primary offset-md-3">Submit</button>
          <button type="reset" class="btn btn-danger mx-2">Cancel</button>
        </form>
      </div>
    </div>
  </div>


@endsection
