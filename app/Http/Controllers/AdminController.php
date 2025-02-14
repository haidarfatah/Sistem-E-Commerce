<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Halaman Dashboard
    public function dashboard()
    {
        // Mengambil jumlah produk, kategori, pesanan, dan pengguna
        $productCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $usersCount = User::count(); // Variabel yang hilang sebelumnya

        // Mengirim data ke view
        return view('admin.dashboard', compact('productCount', 'categoryCount', 'orderCount', 'usersCount'));
    }

    // Halaman Kelola Pengguna
    public function users()
    {
        $users = \App\Models\User::all();
        return view('admin.users.index', compact('users'));
    }

    // Halaman Kelola Kategori

    // Menampilkan Daftar Kategori
    public function categories()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan Formulir untuk Menambah Kategori
    public function createCategory()
    {
        return view('admin.categories.create');
    }

    // Menyimpan Kategori Baru
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:100',
            'description' => 'nullable',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    // Menampilkan Formulir untuk Mengedit Kategori
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Menyimpan Perubahan Kategori
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|max:100',
            'description' => 'nullable',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    // Menghapus Kategori
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }



    // Halaman Kelola Produk
    // Menampilkan Daftar Produk
    public function products()
    {
        $products = Product::with('category')->get(); // Mengambil semua produk beserta kategorinya
        return view('admin.products.index', compact('products'));
    }

    // Menampilkan Formulir untuk Menambah Produk
    public function createProduct()
    {
        $categories = Category::all(); // Ambil daftar kategori untuk dropdown
        return view('admin.products.create', compact('categories'));
    }

    // Menyimpan Produk Baru
    // Menyimpan Produk Baru
    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:100',
            'foto_product' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,category_id',
        ]);

        // Upload Foto ke public/foto_product
        $filePath = $request->file('foto_product')->store('foto_product', 'public');

        Product::create([
            'product_name' => $request->product_name,
            'foto_product' => $filePath,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Mengambil semua kategori
        return view('admin.products.edit', compact('product', 'categories'));
    }


    // Menyimpan Perubahan Produk
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|max:100',
            'foto_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,category_id',
        ]);

        if ($request->hasFile('foto_product')) {
            // Hapus gambar lama jika ada
            if ($product->foto_product) {
                Storage::disk('public')->delete($product->foto_product);
            }

            // Upload gambar baru
            $filePath = $request->file('foto_product')->store('foto_product', 'public');
            $product->foto_product = $filePath;
        }

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }


    // Menghapus Produk
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete($product->foto_product); // Hapus foto produk
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    // Halaman Kelola Pesanan
    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }
}
