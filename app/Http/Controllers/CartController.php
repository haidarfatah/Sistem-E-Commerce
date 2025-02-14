<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('home')->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = min($cart[$productId]['quantity'] + 1, $product->stock);
        } else {
            $cart[$productId] = [
                'name' => $product->product_name,
                'price' => $product->price,
                'quantity' => 1,
                'product_id' => $product->product_id,
                'stock' => $product->stock,
                'foto_product' => $product->foto_product, // Tambahkan foto produk
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('home')->with('success', 'Product added to cart!');
    }



    public function addMultipleToCart(Request $request)
    {
        $selectedProducts = $request->input('products', []); // Ambil produk yang dipilih
        $cart = session()->get('cart', []);

        if (!empty($selectedProducts)) {
            foreach ($selectedProducts as $productId) {
                $product = Product::where('product_id', $productId)->first();

                if ($product) {
                    // Jika produk sudah ada di cart, tambah kuantitasnya
                    if (isset($cart[$productId])) {
                        $cart[$productId]['quantity']++;
                    } else {
                        // Jika produk belum ada di cart, tambahkan produk ke cart
                        $cart[$productId] = [
                            'name' => $product->product_name,
                            'price' => $product->price,
                            'quantity' => 1,
                            'product_id' => $product->product_id, // Pastikan menggunakan product_id
                            'foto_product' => $product->foto_product, // Tambahkan foto produk
                        ];
                    }
                }
            }

            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Selected products added to cart.');
        }

        return redirect()->route('home')->with('warning', 'No products selected.');
    }


    public function updateCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            $product = Product::find($cart[$productId]['product_id']);

            if ($product) {
                // Pastikan kuantitas tidak melebihi stok
                if ($quantity > $product->stock) {
                    return redirect()->back()->with('error', 'Quantity exceeds available stock.');
                }

                // Perbarui kuantitas di session
                $cart[$productId]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        // Arahkan ke halaman checkout setelah update
        return redirect()->route('checkout.index');
    }



    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
    
            $cartSubtotal = array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $cart));
    
            return response()->json(['success' => true, 'cart_subtotal' => number_format($cartSubtotal, 0, ',', '.')]);
        }
    
        return response()->json(['success' => false, 'error' => 'Product not found in cart.']);
    }
    

    public function cart()
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $productId => &$item) {
            $product = Product::where('product_id', $productId)->first();
            if ($product) {
                $item['stock'] = $product->stock;
            } else {
                unset($cart[$productId]); // Hapus item jika produk tidak lagi tersedia
            }
        }
        session()->put('cart', $cart);

        return view('cart.index', compact('cart'));
    }


    public function updateAjax(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $quantity = (int) $request->input('quantity');

            // Validasi produk dan stok
            $product = Product::find($productId);
            if (!$product) {
                return response()->json(['success' => false, 'error' => 'Produk tidak ditemukan.']);
            }

            if ($quantity > $product->stock) {
                return response()->json(['success' => false, 'error' => 'Stok tidak mencukupi.']);
            }

            // Perbarui kuantitas di keranjang
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);

            // Hitung ulang total harga untuk produk ini
            $totalPrice = $quantity * $cart[$productId]['price'];

            // Hitung subtotal seluruh keranjang
            $cartSubtotal = array_sum(array_map(function ($item) {
                return $item['quantity'] * $item['price'];
            }, $cart));

            // Kembalikan data yang diperbarui
            return response()->json([
                'success' => true,
                'total_price' => number_format($totalPrice, 0, ',', '.'),
                'cart_subtotal' => number_format($cartSubtotal, 0, ',', '.'),
                'updated_stock' => $product->stock
            ]);
        }

        return response()->json(['success' => false, 'error' => 'Produk tidak ditemukan dalam keranjang.']);
    }
}
