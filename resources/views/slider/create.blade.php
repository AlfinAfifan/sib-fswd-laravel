@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Slider</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('slider.store') }}" method="POST" class="my-3" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputName" name="title" value="{{ old('title') }}" autofocus>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label ">Caption</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('caption') is-invalid @enderror" id="inputName" name="caption" value="{{ old('caption') }}">
                        @error('caption')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="input-group row mb-3">
                    <label for="inputName" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-3 mx-3">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile02" name="image">
                        <label class="custom-file-label rounded-left" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                    </div>
                    <div class="col-sm-12 offset-sm-3">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
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
