<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    // Menambahkan user_id ke dalam $fillable
    protected $fillable = [
        'user_id',
        'foto_bukti',
        'order_date',
        'status',
        'total_amount',
    ];

    public $timestamps = false;
    // public function details()
    // {
    //     return $this->hasMany(OrderDetail::class, 'order_id');
    // }

    public function orderDetails()
    {
        return $this
            ->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
    

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id');
    // }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id'); // Relasi ke OrderDetail
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    public function show($orderId)
    {
        $order = Order::with('orderDetails.product')->where('order_id', $orderId)->firstOrFail();

        return view('orders.details', compact('order'));
    }
    public function history()
    {
        // Ambil data orders berdasarkan user yang sedang login
        $orders = Order::where('user_id', Auth::id())->get();

        return view('orders.history', compact('orders'));
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
