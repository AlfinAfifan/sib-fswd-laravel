@extends('layouts.main')

@section('content')
<div class="container-fluid">
    @if ($ordersUpdate->isNotEmpty() && Auth::user()->role->name == 'admin')
    <!-- Approve -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-warning">
            <h6 class="m-0 font-weight-bold text-white">Approve Transaction</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Code Transaction</th>
                            <th>User</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordersUpdate as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->code }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp. {{ number_format($order->total_price, 0, 2) }}</td>
                            <td>
                            @if (Auth::user()->role->name == 'admin')
                                <form onsubmit="return confirm('Are you sure not approve data number {{ $loop->iteration }}?');" action="{{ route('transaction.destroy', $order->id) }}" method="POST">
                                    <a href="{{ route('transaction.approve', $order->id) }}" class="btn btn-success btn-sm"><i class="bi bi-check2-square"></i></a>

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

    <!-- index -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Table Data Transaction</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Code Transaction</th>
                            <th>User</th>
                            <th>Total Price</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->code }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp. {{ number_format($order->total_price, 0, 2) }}</td>
                            <td>
                                @if (Auth::user()->role->name == 'admin')
                                <a href="{{ route('transaction.detail', $order->id) }}" type="submit" class="btn btn-primary btn-sm"><i class="bi bi-info-square"></i></a>
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
@endsection
