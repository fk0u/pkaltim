# 🐬 Tim 5 - PesutTrip (Wisata Kalimantan Timur)

**PIC:** Ghani
**Subtema:** Wisata & Budaya Kalimantan Timur

## 👥 Anggota Tim
1. Farhan (Leader & Fullstack Developer)
2. Weka (UI/UX Developer)
3. Lawindra (Backend Developer)

## 📝 Deskripsi Project
**PesutTrip** adalah platform pariwisata digital yang didedikasikan untuk memperkenalkan keindahan alam dan kekayaan budaya Kalimantan Timur. Website ini dirancang untuk memberikan pengalaman eksplorasi yang imersif melalui visual berkualitas tinggi dan informasi yang komprehensif.

Pengguna dapat menemukan berbagai destinasi wisata mulai dari hutan hujan tropis, pantai eksotis, hingga desa budaya Dayak, serta melakukan pemesanan perjalanan dengan mudah.

## 🎯 Fitur Utama
- ✅ **Immersive Landing Page:** Desain visual-first dengan animasi halus menggunakan GSAP.
- ✅ **Pencarian & Filter Canggih:** Cari destinasi berdasarkan lokasi (Samarinda, Balikpapan, Berau) atau kategori (Alam, Budaya, Kuliner).
- ✅ **Detail Destinasi Lengkap:** Galeri foto, deskripsi mendalam, informasi harga, dan rating.
- ✅ **Sistem Booking Online:** Pemesanan tiket wisata instan dengan form yang mudah digunakan.
- ✅ **Review & Rating:** Fitur ulasan pengguna untuk membantu wisatawan lain.
- ✅ **Autentikasi Pengguna:** Login dan Register aman untuk manajemen tiket dan profil.
- ✅ **Admin Dashboard:** Panel khusus untuk mengelola data destinasi dan pesanan.

## 🛠️ Tech Stack
- **Language:** PHP Native (PDO)
- **Frontend:** HTML5, Tailwind CSS (via CDN)
- **Interactivity:** Alpine.js, GSAP (GreenSock Animation Platform)
- **Database:** MySQL
- **Server:** Apache (XAMPP)

## 📦 Installasi & Konfigurasi

### 1. Clone & Setup Folder
Pastikan folder project `tim-05` berada di dalam direktori `htdocs` XAMPP Anda.
Contoh path: `C:\xampp\htdocs\pkaltim\teams\tim-05`

### 2. Setup Database (Otomatis)
Kami menyediakan skrip otomatis untuk membuat database dan mengimpor tabel.
1. Pastikan Apache dan MySQL di XAMPP sudah berjalan (Start).
2. Buka browser dan akses:
   ```
   http://localhost/pkaltim/teams/tim-05/auto_setup_db.php
   ```
3. Jika berhasil, Anda akan melihat pesan sukses. Database `pesuttrip_db` siap digunakan.

*(Opsi Manual: Import file `database.sql` ke database bernama `pesuttrip_db` menggunakan phpMyAdmin)*

### 3. Jalankan Aplikasi
Akses website melalui browser:
```
http://localhost/pkaltim/teams/tim-05/
```

## 🔐 Akun Default
**(Opsional jika ada data dummy)**
- **User:** user@example.com / password
- **Admin:** admin@pesuttrip.com / admin123

## � Roadmap & Progress
- [x] Perancangan Database & Struktur Project
- [x] Implementasi UI/UX Modern (Glassmorphism & Dark Mode)
- [x] Fitur Auth (Login/Register)
- [x] Halaman Utama & Animasi Intro
- [x] Sistem Pencarian & Filter Destinasi
- [x] Halaman Detail & Booking
- [x] Integrasi Database (CRUD Destinasi)
- [ ] Integrasi Payment Gateway (Next Phase)

## Bugs & Fix
- [ ] Optimasi loading gambar untuk koneksi lambat.

---
**Tim 5 - PesutTrip** © 2026
