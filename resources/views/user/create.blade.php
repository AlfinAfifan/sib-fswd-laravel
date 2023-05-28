@extends('layouts.main')

@section('content')
<form class="p-5" action="{{ route('user.store') }}" method="POST">
    @csrf

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" id="inputEmail4" name="email">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" id="inputPassword4" name="password">
      </div>
    </div>
    <div class="form-group">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" placeholder="" name="name">
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="inputPhone">Phone</label>
            <input type="number" class="form-control" id="inputPhone" placeholder="" name="phone">
        </div>
        <div class="form-group col-md-4">
            <label for="inputRole">Role</label>
            <select id="inputRole" class="form-control" name="role">
                <option selected>Choose...</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-danger mx-2">Cancel</button>
  </form>
@endsection
