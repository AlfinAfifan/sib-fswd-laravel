@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row">
      <div class="col ">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('slider.update', $slider->id) }}" method="POST" class="my-5" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="inputName" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputName" name="title" value="{{ $slider->title }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputName" class="col-sm-3 col-form-label">Caption</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputName" name="caption" value="{{ $slider->caption }}">
                        </div>
                    </div>
                    <div class="input-group row mb-3">
                        <label for="inputName" class="col-sm-3 col-form-label">Image</label>
                        <div class="custom-file col-sm-3 mx-3">
                          <input type="file" class="custom-file-input" id="inputGroupFile02" name="image" value="{{ $slider->image }}">
                          <label class="custom-file-label rounded-left" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                        </div>
                      </div>
                    <!-- Tambahkan elemen form lainnya di sini -->
                    <button type="submit" class="btn btn-primary offset-md-3">Submit</button>
                    <button type="reset" class="btn btn-danger mx-2">Cancel</button>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>


@endsection
