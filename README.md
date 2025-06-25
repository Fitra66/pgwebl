# 🌐 Pasarku - Website Peta Pasar Interaktif DIY

**Pasarku** adalah aplikasi web berbasis peta interaktif yang menyajikan informasi seputar pasar-pasar tradisional di Yogyakarta. Aplikasi ini dirancang untuk memudahkan pengguna mencari lokasi pasar, memberikan voting kategori, serta melihat statistik secara visual.

## ✨ Fitur Unggulan

- 🗺️ **Peta Interaktif**: Menampilkan lokasi pasar secara real-time menggunakan Leaflet.
- 📋 **Daftar Pasar & Fitur Go To**: Navigasi cepat ke lokasi pasar.
- 📊 **Statistik & Voting**: Sistem voting kategori pasar yang langsung tercermin dalam diagram.
- ➕ **Tambah Pasar**: Pengguna bisa menambahkan pasar baru secara mandiri.

## 🚀 Teknologi yang Digunakan

- Laravel 11
- Blade Template Engine
- Leaflet.js
- Chart.js
- Bootstrap 5
- MySQL

## 🧭 Cara Menjalankan (Localhost)

```bash
git clone https://github.com/username/pasarku.git
cd pasarku
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
