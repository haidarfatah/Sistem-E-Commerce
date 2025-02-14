<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    public $timestamps = false; // Nonaktifkan timestamps

    protected $fillable = [
        'product_name',
        'foto_product',
        'description',
        'price',
        'stock',
        'category_id',
        'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
}
