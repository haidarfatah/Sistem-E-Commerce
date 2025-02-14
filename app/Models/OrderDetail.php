<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_detail_id';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'user_id'
    ];
    
   

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order()
{
    return $this->belongsTo(Order::class, 'order_id', 'order_id');
}

}

