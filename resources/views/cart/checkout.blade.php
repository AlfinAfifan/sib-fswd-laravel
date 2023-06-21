@extends('layouts.landing')

@section('content')

    <div class="container padding-bottom-3x mb-1 mt-5 pb-5" style="width: 75%">
        <div class="card mb-5 shadow">
            <div class="card-body">
                <h4>Checkout Berhasil</h4>
                Pesanan anda berhasil dibuat,lakukan pembayaran untuk proses selanjutnya. Nomor Rekening Bank BRI: <strong>655801043725533</strong>, dengan nominal <strong>Rp.
                    @if ($order) {{ number_format($order->total_price) }}.
                    @else 0.
                    @endif</strong> Lalu konfirmasi pembayaran jika pembayaran sudah dilakukan.
            </div>
        </div>

        <div class="table-responsive shopping-cart card shadow mb-5">
            <div class="card-body">
                <div class="mb-4 row">
                    <div class="col-md-6 h5">
                        <i class="bi bi-cart-check-fill mr-3"></i>Detail Pesanan
                    </div>
                    <div class="col-md-6 text-right small">
                        <i class="">Kode Transaksi: @if ($order) {{ $order->code }}
                                                    @else -
                                                    @endif
                        </i>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse ($orderDetail as $detail)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $detail->products->name }}</td>
                                <td>Rp. {{ number_format($detail->products->price) }}</td>
                                <td>{{ $detail->total }}</td>
                                <td>Rp. {{ number_format($detail->total_price, 0) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td>
                                    <h4>Produk belum tersedia</h4>
                                </td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>


                <div class="column text-right"><strong>Subtotal: </strong>
                    @if ($order) {{ number_format($order->total_price) }}
                    @else 0
                    @endif
                </div>
                <div class="shopping-cart-footer row mt-4">
                    <div class="col text-left">
                        <a class="btn btn-outline-secondary" href="{{ route('landing.index') }}"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a>
                    </div>
                    <div class="col text-right">
                        <a class="btn btn-success" href="{{ route('cart.confirm') }}">Konfirmasi</a>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

{{-- default rating dan sale_price --}}
