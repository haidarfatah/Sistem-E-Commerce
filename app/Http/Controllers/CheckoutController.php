<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty!');
        }

        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout.index', compact('cart', 'totalAmount'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout.index')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Simpan foto bukti pembayaran
            $fotoBuktiPath = $request->file('foto_bukti')->store('foto_bukti', 'public');

            // Hitung total harga pesanan
            $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            // Simpan data pesanan ke tabel orders
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => Auth::id(),  // Menggunakan Auth::id() yang benar
                'foto_bukti' => $fotoBuktiPath,
                'order_date' => now(),
                'status' => 'pending',
                'total_amount' => $totalAmount,
            ]);

            // Simpan setiap item dalam keranjang ke tabel order_details
            foreach ($cart as $item) {
                // Validasi stok produk
                $product = DB::table('products')->where('product_id', $item['product_id'])->first();

                if (!$product) {
                    throw new \Exception("Product not found: {$item['name']}.");
                }

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$item['name']}.");
                }

                // Kurangi stok produk
                DB::table('products')
                    ->where('product_id', $item['product_id'])
                    ->decrement('stock', $item['quantity']);

                // Simpan detail pesanan tanpa 'user_id' di order_details
                DB::table('order_details')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart');

            DB::commit();

            return redirect()->route('home')->with('success', 'Order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error during checkout: ' . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Error during checkout: ' . $e->getMessage());
        }
    }




    public function status($orderId)
    {
        $order = Order::where('order_id', $orderId)
            ->where('user_id', Auth::user()->user_id) // Validasi user_id
            ->firstOrFail();

        return view('orders.status', compact('order'));
    }

    public function completeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'user_id' => Auth::user()->user_id, // Menggunakan user_id
            'total_amount' => array_reduce($cart, fn($total, $item) => $total + ($item['price'] * $item['quantity']), 0),
            'status' => 'pending',
            'foto_bukti' => '', // Kosong untuk sementara
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return view('orders.status', ['order' => $order]);
    }
}
