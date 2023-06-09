@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="my-3">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputRole">Role</label>
                        <select id="inputRole" class="form-select @error('role') is-invalid @enderror" name="role">
                            <option selected disabled>Choose...</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail4" name="email" value="{{ $user->email }}" autofocus>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword4" name="password" value="{{ $user->password }}">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="" name="name" value="{{ $user->name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPhone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" placeholder="" name="phone" value="{{ $user->phone }}">
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputName" class="">Image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile01" name="image">
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('user.index') }}" class="btn btn-danger mx-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
