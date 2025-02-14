<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';  // Pastikan primary key adalah 'user_id'
    public $timestamps = false; // Jika tidak menggunakan timestamp otomatis
    public $incrementing = false; // Jika 'user_id' bukan auto increment
    protected $keyType = 'string'; // Jika 'user_id' adalah tipe string

    protected $fillable = [
        'name', 'email','password', 'foto_users', 'address', 'phone', 'role', 'created_at'
    ];

    protected $hidden = ['password'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'user_id');
    }
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
    
}
