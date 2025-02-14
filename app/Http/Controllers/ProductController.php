<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($productId);

        // Kembalikan view dengan data produk
        return view('products.show', compact('product'));
    }
}

