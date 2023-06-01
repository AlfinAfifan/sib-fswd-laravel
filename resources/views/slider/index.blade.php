@extends('layouts.main')

@section('content')

    <!-- Main Content -->
    <div id="content">

      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->

        @if (Auth::user()->role->name == 'admin')
        <a href="{{ route('slider.create') }}" class="btn btn-primary my-3">Create New</a>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tables Slider</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Caption</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($sliders as $slider)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $slider->title }}</td>
                        <td>{{ $slider->caption }}</td>
                        <td>
                            <img src="{{ asset('storage/slider/' . $slider->image) }}" alt="{{ $slider->title }}" style="max-width:100px;">
                        </td>
                        <td>
                            @if (Auth::user()->role->name == 'admin')
                                <form onsubmit="return confirm('Are you sure delete data number {{ $loop->iteration }}?');" action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                    <a href="{{ route('slider.edit', $slider->id) }}" type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>

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
