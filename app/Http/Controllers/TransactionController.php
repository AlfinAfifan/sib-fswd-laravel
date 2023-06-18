<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::where('approve', true)->get();
        $ordersUpdate = Order::where('approve', false)->get();

        return view('transaction.index', compact('orders', 'ordersUpdate'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('transaction.index');
    }

    public function approve($id)
    {
        Order::find($id)->update([
            'approve' => true,
        ]);

        return redirect()->route('transaction.index');
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $orderDetail = OrderDetail::where('order_id', $id)->get();

        return view('transaction.detail', compact('order', 'orderDetail'));
    }
}
