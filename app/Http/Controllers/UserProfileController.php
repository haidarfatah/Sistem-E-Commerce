<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    // Menampilkan halaman profil pengguna
    public function show()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Menampilkan halaman profil dengan data pengguna
        return view('profile.show', compact('user'));
    }

    // Menampilkan halaman edit profil
    public function edit()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Menampilkan halaman edit profil dengan data pengguna
        return view('profile.edit', compact('user'));
    }

    // Update data profil pengguna

    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user yang sedang login
    
        // Cek apakah $user adalah instance dari model Eloquent
        if (!$user) {
            return redirect()->route('profile.show')->with('error', 'User not found.');
        }
    
        // Periksa dan set nilai input (tanpa validasi)
        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->address = $request->input('address', $user->address);
        $user->phone = $request->input('phone', $user->phone);
    
        // Jika ada file yang diunggah
        if ($request->hasFile('foto_users')) {
            $file = $request->file('foto_users');
    
            // Periksa apakah file valid
            if ($file->isValid()) {
                // Hapus foto lama jika ada
                if ($user->foto_users && Storage::exists('public/foto_users/' . $user->foto_users)) {
                    Storage::delete('public/foto_users/' . $user->foto_users);
                }
    
                // Simpan foto baru
                $path = $file->store('foto_users', 'public');
                $user->foto_users = basename($path); // Simpan nama file saja
            }
        }
    
        // Simpan perubahan
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
    
}
