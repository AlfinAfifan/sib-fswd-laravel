@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Slider</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="my-3">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputName" name="title" value="{{ $slider->title }}" autofocus>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label">Caption</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('caption') is-invalid @enderror" id="inputName" name="caption" value="{{ $slider->caption }}">
                        @error('caption')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label">Image</label>
                    <div class="input-group mb-3 ms-2 col-sm-4">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile01" name="image">
                    </div>
                    <div class="col">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Tambahkan elemen form lainnya di sini -->
                <button type="submit" class="btn btn-primary offset-md-3">Submit</button>
                <a href="{{ route('slider.index') }}" class="btn btn-danger mx-2">Cancel</a>
            </form>
        </div>
    </div>
</div>


@endsection
