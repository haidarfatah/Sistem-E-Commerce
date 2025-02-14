<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        logger('Logged in user: ' . $user->name . ', Role: ' . $user->role);

        $products = Product::all();

        return view('home', compact('products'));
    }
}

