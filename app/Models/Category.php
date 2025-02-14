<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id'; // Tentukan primary key jika berbeda
    protected $fillable = ['category_name', 'description'];

    // Menambahkan mutator untuk mengubah tanggal menjadi objek Carbon
    protected $dates = ['created_at', 'updated_at']; // Laravel akan otomatis mengonversi field ini menjadi objek Carbon
    public $timestamps = false; 
}
