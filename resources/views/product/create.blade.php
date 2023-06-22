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
                        <select id="inputRole" class="form-select @error('category') is-invalid @enderror" name="category">
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
                    <div class="form-group col-md-12">
                        <label for="inputName">Product Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="inputName" name="description">{{ old('description') }}</textarea>
                        @error('description')
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
                                <input type="text" class="form-control @error('sale_price') is-invalid @enderror" id="inputPrice2" name="sale_price" placeholder="0" value="{{ old('sale_price') ? old('sale_price') : 0 }}">
                            </div>
                            @error('sale_price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputRole">Brand</label>
                        <select id="inputRole" class="form-select @error('brand') is-invalid @enderror" name="brand">
                            <option selected disabled>Choose...</option>
                            @foreach ($brands as $brand)
                            <option value="{{ $brand->name }}" {{ old('brand') == $brand->name ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputRating">Rating</label>
                        <input type="text" class="form-control @error('rating') is-invalid @enderror" id="inputRating" placeholder="Input 1-5" name="rating" value="{{ old('rating') ? old('rating') : 0 }}">
                        @error('rating')
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
                <a href="{{ route('product.index') }}" class="btn btn-danger mx-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
