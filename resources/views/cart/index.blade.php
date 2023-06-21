@extends('layouts.landing')

@section('content')
        <div class="container padding-bottom-3x mb-5 mt-5 pb-5 pt-2" style="width: 75%">
            <div class="table-responsive shopping-cart">
                @if (Session::get('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr class="">
                            <th>Product Name</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">
                                <form onsubmit="return confirm('Are you sure delete all product?')" action="{{ route('cart.destroyAll') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Clear Cart</button>
                                </form>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orderDetail)
                            @foreach ($orderDetail as $detail)
                            <tr>
                                <td>
                                    <div class="product-item d-flex">
                                        <a class="product-thumb" href="{{ route('landing.detail', ['id' => $detail->products->id]) }}"><img src="{{ asset('storage/product/'. $detail->products->image) }}" alt="Product" style="max-width: 110px;"/></a>
                                        <div class="product-info ms-4 my-auto">
                                            <h4 class="fs-6"><a class="text-decoration-none text-dark" href="{{ route('landing.detail', ['id' => $detail->products->id]) }}">{{ $detail->products->name }}</a></h4>
                                            <span><em>Size:</em> 10.5</span> <br>
                                            <span><em>Color:</em> Dark Blue</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-lg text-medium my-auto fs-6">Rp. {{ number_format($detail->products->price) }}</td>
                                <td class="text-center text-lg my-auto fs-6">{{ $detail->total }}</td>
                                <td class="text-center text-lg my-auto fs-6">Rp. {{ number_format($detail->total_price, 0) }}</td>
                                <td class="text-center my-auto">
                                    <form onsubmit="return confirm('Are you sure delete product number {{ $loop->iteration }}?');" action="{{ route('cart.destroy', $detail->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <h4>Produk belum tersedia</h4>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

            <div class="column text-right"><strong>Subtotal: </strong>
                @if ($order) {{ number_format($order->total_price) }}
                @else 0
                @endif
            </div>
            <hr>
            <div class="shopping-cart-footer row">
                <div class="col">
                    <a class="btn btn-outline-secondary" href="{{ route('landing.index') }}"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a>
                </div>
                <div class="col text-right">
                        <a class="btn btn-success" href="{{ route('cart.checkout') }}">Checkout</a>
                </div>
            </div>
        </div>
@endsection

