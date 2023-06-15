@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Product</h6>
        </div>
            <div class="card-body">
            <form class="" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="my-3">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputRole">Category Product</label>
                        <select id="inputRole" class="form-control @error('category') is-invalid @enderror" name="category">
                            <option selected disabled>Choose...</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputName">Product Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" name="name" value="{{ old('name') }}" autofocus>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPrice">Price</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="inputPrice" name="price" placeholder="0" value="{{ old('price') }}">
                            </div>
                            @error('price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPrice2">Sale Price</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control @error('sale_price') is-invalid @enderror" id="inputPrice2" name="sale_price" placeholder="0" value="{{ old('sale_price') }}">
                            </div>
                            @error('sale_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputRole">Brand</label>
                        <select id="inputRole" class="form-control @error('brand') is-invalid @enderror" name="brand">
                            <option selected disabled>Choose...</option>
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputRating">Rating</label>
                        <input type="text" class="form-control @error('rating') is-invalid @enderror" id="inputRating" placeholder="Input 1-5" name="rating" value="{{ old('rating') }}">
                        @error('rating')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputName" class="">Image</label>
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="inputGroupFile02" name="image">
                            <label class="custom-file-label rounded-left" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                        </div>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url()->previous() }}" class="btn btn-danger mx-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
