@extends('layouts.main')

@section('content')

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            @if ($productsUpdate->isNotEmpty() && Auth::user()->role->name == 'admin')
            <!-- Approve -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-warning">
                    <h6 class="m-0 font-weight-bold text-white">Approve Product</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Nama</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th style="width: 45%;">Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productsUpdate as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/product/'.$product->image) }}" alt="{{ $product->name }}" style="max-width: 75px;">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>Rp. {{ number_format($product->price, 0, 2) }}</td>
                                        <td>Rp. {{ number_format($product->sale_price, 0, 2) }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                        @if (Auth::user()->role->name == 'admin')
                                            <a href="{{ route('product.approve', $product->id) }}" class="btn btn-success btn-sm"><i class="bi bi-check2-square"></i></a>
                                            <form onsubmit="return confirm('Are you sure not approve data number {{ $loop->iteration }}?');" action="{{ route('product.destroy', $product->id) }}" method="POST" class="mt-2">

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-x-square"></i></button>
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
            @endif

            <!-- Page Heading -->
            @if (Auth::user()->role->name == 'admin' || Auth::user()->role->name == 'staff')
            <a href="{{ route('product.create') }}" class="btn btn-primary my-3">Create New</a>
            @endif

            <!-- index -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tables Product</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Nama</th>
                                    <th>Price</th>
                                    <th>Sale Price</th>
                                    <th style="width: 45%;">Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/product/'.$product->image) }}" alt="{{ $product->name }}" style="max-width: 75px;">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>Rp. {{ number_format($product->price, 0, 2) }}</td>
                                        <td>Rp. {{ number_format($product->sale_price, 0, 2) }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>
                                        @if (Auth::user()->role->name == 'admin')
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square "></i></a>
                                            <form onsubmit="return confirm('Are you sure delete data number {{ $loop->iteration }}?');" action="{{ route('product.destroy', $product->id) }}" method="POST" class="mt-2">
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
