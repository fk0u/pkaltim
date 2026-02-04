# 🏞️ Tim 1 - Wisata Alam Kalimantan Timur (WisataKaltim)

**PIC:** Navies
**Subtema:** Wisata Alam Kalimantan Timur (WisataKaltim)

## 👥 Anggota Tim
1. Glenn (Leader, Frontend & backend, Analyst)
2. Bregas (Frontend & backend)
3. Reza (UI/UX)

## 📝 Deskripsi Project
Website promosi dan informasi destinasi wisata alam unggulan di Kalimantan Timur. Website ini memudahkan wisatawan untuk mencari lokasi wisata, melihat fasilitas, galeri foto, serta memberikan ulasan pengalaman mereka.

![Tampilan Landing Page](teams/tim-01/screenshots/landingpage.png)

## 🎯 Fitur Utama
- ✅ **Landing Page Modern:** Desain responsif, hero section menarik, dan kartu destinasi premium.
- ✅ **Pencarian & Filter:** Filter berdasarkan kategori, rentang harga, dan pencarian nama wisata.
- ✅ **Detail Destinasi:** Informasi lengkap, peta lokasi (Google Maps), harga, jam buka, dan fasilitas.
- ✅ **Galeri Foto:** Slider foto interaktif untuk setiap destinasi.
- ✅ **Rating & Ulasan:** Pengunjung dapat memberikan rating dan komentar (dimoderasi admin).
- ✅ **Admin Dashboard:**
    - Login Admin Aman
    - Manajemen CRUD Destinasi
    - Manajemen Kategori
    - Moderasi Ulasan Pengunjung
    - Upload & Manajemen Foto

## 🛠️ Tech Stack
- **Framework:** Laravel 12
- **Language:** PHP 8.2
- **Frontend:** Blade Templates, Tailwind CSS 4, Alpine.js
- **Database:** MySQL
- **Assets:** Vite

## 📦 Installasi & Konfigurasi

### 1. Clone Repository
```bash
git clone [URL_REPO_TIM_1]
cd tim-1-wisata-alam
```

### 2. Install Dependencies
Pastikan Composer dan Node.js sudah terinstall.
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database.
```bash
cp .env.example .env
php artisan key:generate
```
Edit `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pkaltim_tim1
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database
Jalankan migrasi untuk membuat tabel:
```bash
php artisan migrate
```
*(Opsional)* Jalankan seeder jika tersedia untuk data dummy:
```bash
php artisan db:seed
```

### 5. Jalankan Aplikasi
Buka dua terminal terpisah:

**Terminal 1 (Backend Server):**
```bash
php artisan serve
```

**Terminal 2 (Frontend Build/Watch):**
```bash
npm run dev
```

Akses website di: `http://localhost:8000`

### 🔐 Akun Admin Default
(Jika menggunakan seeder default)
- **Username:** admin
- **Password:** password

## � Roadmap & Progress
- [x] Perancangan Database & Migrations
- [x] Setup Laravel & Tailwind CSS
- [x] CRUD Data Master (Kategori, Destinasi, Fasilitas)
- [x] Implementasi Halaman Publik (Landing, Detail)
- [x] Fitur Filter & Pencarian
- [x] Sistem Review & Rating
- [x] Galeri Foto Dinamis
- [ ] Finalisasi Deployment

## Bugs & Fix
- [ ] Penggunaan Memory meningkat setiap halaman di-refresh

---
**Tim 1 - Wisata Alam Kaltim** © 2026