@extends('layouts.main')

@section('content')

    <!-- Main Content -->
    <div id="content">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>

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
                    <th>Avatar</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>
                        <img src="https://placehold.co/50x50" alt="">
                    </td>
                    <td>Edinburgh</td>
                    <td>Edinburgh</td>
                    <td>Edinburgh</td>
                    <td>Edinburgh</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></button>
                    </td>
                  </tr>

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
