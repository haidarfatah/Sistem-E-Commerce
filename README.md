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

```sh
1. Unduh file SQL dari tautan di atas.
2. Buka aplikasi database (phpMyAdmin, MySQL Workbench, atau CLI).
3. Buat database baru, contoh: `ecommerce_db`.
4. Impor file SQL ke dalam database tersebut.
5. Sesuaikan konfigurasi `.env` dengan nama database yang dibuat.

git clone https://github.com/username/ecommerce-platform.git
cd ecommerce-platform
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve

Admin:
Email    : admin@example.com
Password : password

Customer:
Email    : customer@example.com
Password : password

Backend    : Laravel 11
Database   : MySQL
Frontend   : Blade, Tailwind CSS
Autentikasi: Laravel Middleware

Dashboard Admin    : ![Dashboard](https://raw.githubusercontent.com/username/ecommerce-platform/main/public/images/dashboard.png)
Halaman Produk     : ![Produk](https://raw.githubusercontent.com/username/ecommerce-platform/main/public/images/products.png)
Keranjang Belanja  : ![Keranjang](https://raw.githubusercontent.com/username/ecommerce-platform/main/public/images/cart.png)
