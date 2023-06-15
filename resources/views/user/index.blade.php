@extends('layouts.main')

@section('content')

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            @if (Auth::user()->role->name == 'admin')
            <a href="{{ route('user.create') }}" class="btn btn-primary my-3">Create New</a>
            @endif


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Tables User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Avatar</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($user->avatar)
                            <img src="{{ asset('storage/user/' . $user->avatar) }}" alt="{{ $user->name }}" style="max-width:50px;">
                            @else
                            <img src="{{ asset('img/profil.jpg') }}" alt="no-profil" style="max-width:50px;">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td><span class="badge text-light {{ $user->role->name == 'admin' ? 'bg-success': 'bg-primary' }}">{{ $user->role->name }}</span></td>
                        <td>
                            @if (Auth::user()->role->name == 'admin')
                                <form onsubmit="return confirm('Are you sure delete data number {{ $loop->iteration }}?');" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    <a href="{{ route('user.edit', $user->id) }}" type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                                </form>
                            @else
                                <span class="badge bg-danger text-light">Disable</span>
                            @endif
                        </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

@endsection
