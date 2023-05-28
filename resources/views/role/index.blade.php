@extends('layouts.main')

@section('content')

    <!-- Main Content -->
    <div id="content">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
        <a href="{{ route('role.create') }}" class="btn btn-primary my-3">Create New</a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($roles as $role)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                        <form onsubmit="return confirm('Are you sure delete data number {{ $loop->iteration }}?');" action="{{ route('role.destroy', $role->id) }}" method="POST">
                            <a href="{{ route('role.edit', $role->id) }}" type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                        </form>
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
