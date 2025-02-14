  ```md
# 🛒 E-Commerce Platform

Selamat datang di **E-Commerce Platform**, sebuah sistem berbasis Laravel yang memungkinkan pengguna untuk menjelajahi produk, menambahkan ke keranjang, melakukan transaksi, dan mengelola pesanan.

---

## 📌 Fitur Utama

- ✅ **Autentikasi Pengguna** (Register, Login, Logout)  
- ✅ **Role-Based Access Control** (Admin & Customer)  
- ✅ **Manajemen Produk** (Tambah, Edit, Hapus oleh Admin)  
- ✅ **Keranjang Belanja** (Add to Cart, Update, Remove)  
- ✅ **Riwayat Pemesanan** untuk melihat pesanan sebelumnya  
- ✅ **Dashboard Admin** untuk mengelola produk & transaksi  
- ✅ **Desain Responsif & Interaktif** dengan kombinasi warna estetis  

---

## 📥 Download Database

Untuk mengimpor database, silakan unduh file SQL berikut:  
🔗 **[Download Database](https://drive.google.com/file/d/1EF420qzFSwhSOxeKyiOjnkb5dZoWERBG/view?usp=drive_link)**  

### 📌 Cara Menggunakan:

1. **Unduh** file SQL dari tautan di atas.  
2. **Buka** aplikasi database (phpMyAdmin, MySQL Workbench, atau CLI).  
3. **Buat database baru**, contoh: `ecommerce_db`.  
4. **Impor** file SQL ke dalam database tersebut.  
5. **Sesuaikan konfigurasi** `.env` dengan nama database yang dibuat.  

---

## 🚀 Instalasi & Konfigurasi

### 1️⃣ **Clone Repository**  

```sh
git clone https://github.com/username/ecommerce-platform.git
cd ecommerce-platform
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

🌐 **Akses aplikasi di:** [`http://localhost:8000`](http://localhost:8000)  

---

## 🔑 Akun Login Awal

Gunakan kredensial berikut untuk login:  

```sh
Admin:
Email    : admin@example.com
Password : password

Customer:
Email    : customer@example.com
Password : password
```

---

## 🛠 Teknologi yang Digunakan

```sh
Backend    : Laravel 11
Database   : MySQL
Frontend   : Blade, Tailwind CSS
Autentikasi: Laravel Middleware
```


---
