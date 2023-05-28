@extends('layouts.main')

@section('content')
<form class="p-5" action="{{ route('product.store') }}" method="POST">
    @csrf

    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="inputRole">Category Product</label>
            <select id="inputRole" class="form-control" name="category">
                <option selected>Choose...</option>
                @foreach ($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="inputName">Product Name</label>
            <input type="text" class="form-control" id="inputName" name="name">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputPrice">Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="number" class="form-control" id="inputPrice" name="price" placeholder="0">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="inputPrice2">Sale Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Rp.</div>
                    </div>
                    <input type="number" class="form-control" id="inputPrice2" name="sale_price" placeholder="0">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputBrand">Brand</label>
            <input type="text" class="form-control" id="inputBrand" placeholder="" name="brand">
        </div>
        <div class="form-group col-md-6">
            <label for="inputRating">Rating</label>
            <input type="number" class="form-control" id="inputRating" placeholder="Input 1-5" name="rating">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-danger mx-2">Cancel</button>
  </form>
@endsection
