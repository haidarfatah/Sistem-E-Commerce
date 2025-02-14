<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;


class OrderController extends Controller
{

    public function confirmation($order_id)
    {
        $order = Order::with('details.product')->find($order_id);

        return view('order_confirmation', compact('order'));
    }

    public function status($orderId)
    {
        // Mengambil data pesanan berdasarkan ID
        $order = Order::findOrFail($orderId);
        return view('order.status', compact('order'));
    }

    public function history()
    {
        $user = Auth::user(); // Ambil user dari Auth
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $userId = $user->user_id; // Ambil user_id dari user
        $orders = Order::where('user_id', $userId)->get();

        Log::info('Orders for user_id: ' . $userId, $orders->toArray());

        return view('history.index', compact('orders'));
    }



    public function details($product_id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($product_id);

        return view('history.show', compact('order'));
    }
    public function show($orderId)
    {
        $order = Order::with('orderDetails.product')->where('order_id', $orderId)->firstOrFail();

        return view('orders.show', compact('order'));
    }

    public function showOrderDetails($orderId)
    {
        $order = Order::with('orderDetails.product')->findOrFail($orderId);

        if ($order->orderDetails->isEmpty()) {
            dd('No order details found for this order.');
        }

        dd($order->toArray()); // Debug semua data sebelum dikirim ke view

        return view('order.show', compact('order'));
    }
   
    
   
}
