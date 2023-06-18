<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // hitung produk dalam cart
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if ($order) {
            $totalCart = OrderDetail::where('order_id', $order->id)->get()->count();
        } else {
            $totalCart = 0;
        }

        if ($order) {
            $orderDetail = OrderDetail::with('products')->where('order_id', $order->id)->get();
            return view('cart.index', compact('categories', 'order', 'orderDetail', 'totalCart'));
        }

        $orderDetail = null;
        return view('cart.index', compact('categories', 'order', 'orderDetail', 'totalCart'));

    }


    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // validasi dan simpan order
        $order = Order::firstOrCreate([
            'user_id' => Auth::user()->id,
            'status' => 0,
        ], [
            'date' => Carbon::now(),
            'total_price' => 0,
        ]);

        // update total_price pada order
        $order->update([
            'total_price' => $order->total_price + ($product->price * $request->total),
        ]);

        // simpan order_detail
        $new_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order_detail = OrderDetail::where('product_id', $product->id)->where('order_id', $new_order->id)->first();

        if(empty($order_detail)) {
            OrderDetail::Create(
                ['product_id' => $product->id,
                'order_id' => $order->id,
                'total' => $request->total,
                'total_price' => $product->price * $request->total]);
        } else {
            $totalOld = $order_detail->total;
            $order_detail->update([
                'total' => $totalOld + $request->total,
                'total_price' => $product->price * ($totalOld + $request->total),
            ]);
        }

        return redirect()->route('landing.detail', $id)->with('success', 'Produk berhasil ditambahkan');
    }

    public function landingAdd(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // validasi dan simpan order
        $order = Order::firstOrCreate([
            'user_id' => Auth::user()->id,
            'status' => 0,
        ], [
            'date' => Carbon::now(),
            'total_price' => 0,
        ]);

        // update total_price pada order
        $order->update([
            'total_price' => $order->total_price + ($product->price * $request->total),
        ]);

        // simpan order_detail
        $new_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order_detail = OrderDetail::where('product_id', $product->id)->where('order_id', $new_order->id)->first();

        if(empty($order_detail)) {
            OrderDetail::Create(
                ['product_id' => $product->id,
                'order_id' => $order->id,
                'total' => $request->total,
                'total_price' => $product->price * $request->total]);
        } else {
            $totalOld = $order_detail->total;
            $order_detail->update([
                'total' => $totalOld + $request->total,
                'total_price' => $product->price * ($totalOld + $request->total),
            ]);
        }

        return redirect()->route('landing.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function checkout()
    {
        $categories = Category::all();
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if ($order) {
            $orderDetail = OrderDetail::with('products')->where('order_id', $order->id)->get();
            $totalCart = OrderDetail::where('order_id', $order->id)->get()->count();

            return view('cart.checkout', compact('categories', 'order', 'orderDetail', 'totalCart'));
        } else {
            $totalCart = 0;
            $orderDetail = OrderDetail::all();

            return redirect()->back()->with('error', 'Keranjang belanja masih kosong');
        }
    }

    public function confirm()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->where('approve', false)->first();

        // Tambahkan kode unik pembayaran
        $order->update([
            'status' => 1,
            'code' => mt_rand(100, 9999),
        ]);

        // Kirim konfirmasi ke wa
        $nomorWhatsApp = '+6285854455376';
        $pesan = "Konfirmasi pembayaran dengan detail:\n\nKode transaksi : #$order->code\nTotal Pembayaran : Rp. $order->total_price\n\nSegera kirim bukti screenshoot / foto pembayaran ke nomor ini";
        $pesanUrlEncoded = urlencode($pesan);
        $waUrl = "https://api.whatsapp.com/send?phone=$nomorWhatsApp&text=$pesanUrlEncoded";

        return redirect()->away($waUrl);
    }

    public function destroy($id)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $orderDetail = OrderDetail::find($id);

        $order->update([
            'total_price' => $order->total_price - $orderDetail->total_price
        ]);

        $orderDetail->delete();

        $countOrderDetail = OrderDetail::where('order_id', $order->id)->count();
        if ($countOrderDetail == 0) {
            $order->delete();
        }

        return redirect()->route('cart.index');
    }

    public function destroyAll()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order->update([
            'total_price' => 0
        ]);

        $orderDetail = OrderDetail::where('order_id', $order->id);
        $orderDetail->delete();
        $order->delete();

        return redirect()->route('cart.index');
    }

}
