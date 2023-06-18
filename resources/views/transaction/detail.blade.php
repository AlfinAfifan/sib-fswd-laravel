@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Detail Transaction</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 ms-3">User</div>: {{ $order->user->name }}
                </div>
                <div class="row">
                    <div class="col-md-2 ms-3">Code Transaction</div>: {{ $order->code }}
                </div>
                <div class="row">
                    <div class="col-md-2 ms-3">Date</div>: {{ $order->date }}
                </div>
                <div class="row mb-4">
                    <div class="col-md-2 ms-3">Total Payment</div>: Rp. {{ number_format($order->total_price) }}
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderDetail as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->products->name }}</td>
                                <td>Rp. {{ number_format($detail->products->price) }}</td>
                                <td>{{ $detail->total }}</td>
                                <td>Rp. {{ number_format($detail->total_price, 0, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left-circle me-2"></i>Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
