<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
class AdminOrderController extends Controller
{
    /**
     * Menampilkan daftar order untuk admin.
     */
    public function index()
    {
        // Ambil semua orders beserta user terkait
        $orders = Order::with('user')->get();

        return view('admin.orders.index', compact('orders'));
    }

  

    public function show($order_id)
{
    // Ambil order dengan relasi user dan details
    $order = Order::with(['user', 'details.product'])->find($order_id);

    // Cek apakah order ditemukan
    if (!$order) {
        return redirect()->route('orders.index')->with('error', 'Order tidak ditemukan');
    }

    return view('admin.orders.show', compact('order'));
}

    
    

    /**
     * Memperbarui status order.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
}
