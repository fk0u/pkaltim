# 🍲 Tim 06 - Wisata Kuliner Kaltim

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=flat-square&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=flat-square&logo=mysql&logoColor=white)

**PIC:** [Navies]  
**Subtema:** Kuliner Khas Kalimantan Timur

---

## 👥 Anggota Tim
1. **[Muhammad Fauzan]** 
2. **[Nur Nizar Ahnaf]** 
3. **[Tristan Richardo Pieterson Pondaag]** 

---

## 📝 Deskripsi Project
Website ini adalah platform informasi digital yang menampilkan berbagai informasi kuliner khas Kalimantan Timur.

Website ini memisahkan hak akses antara **Pengunjung (Public)** untuk mencari informasi, dan **Admin** untuk mengelola data (CRUD).

---

## 🚀 Fitur Utama

### 🌍 Halaman Publik (Pengunjung)
* **Beranda (Home):** Tampilan visual menarik dengan rekomendasi kuliner terbaik.
* **Katalog Kuliner:** Daftar makanan lengkap dengan fitur filter kategori.
* **Pencarian:** Cari makanan berdasarkan nama.
* **Detail Makanan:** Informasi lengkap tentang kuliner, harga, peta lokasi, review dan rating.

### 🔐 Halaman Admin
* **Dashboard Admin:** Total Data-data kuliner, rumah makan, review, dan daerah. Statistik jumlah data kuliner dan top rumah makan.
* **Kelola Data (CRUD):** Tambah, Edit, dan Hapus data kuliner serta rumah makan.
* **Autentikasi:** Login aman khusus admin.

---

## 🎯 Target & Status Fitur
Berikut adalah progress pengerjaan fitur aplikasi kami:

- [x] **Setup Project & Database** (Selesai)
- [x] **Authentication** (Login Admin)
- [x] **Database Relational** (Tabel User, Makanan, Rumah Makan, Menu, Review)
- [x] **CRUD Data Kuliner dan Rumah Makan** (Create, Read, Update, Delete)
- [x] **Halaman Public** (Daftar Makanan & Detail)
- [x] **Fitur Pencarian & Filter**
- [x] **Fitur Peta Lokasi**
- [x] **Fitur Review & Rating**
- [x] **Responsive UI** 

---

## 🛠️ Teknologi yang Digunakan
* **Framework:** Laravel 12
* **Bahasa:** PHP 8.2+
* **Database:** MySQL
* **Frontend:** Blade Templates + Bootstrap 5
* **Server:** Apache (Laragon)

---

## 📦 Cara Instalasi (How to Run)
Jika ingin menjalankan project ini di komputer lokal, ikuti langkah berikut:

1.  **Masuk ke direktori:**
    ```bash
    cd pkaltim/teams/tim-06
    ```
2.  **Install Vendor:**
    ```bash
    composer install
    ```
3.  **Setup Environment:**
    * Copy file `.env.example` menjadi `.env`.
    * Atur database: `DB_DATABASE=db_kulinerkaltim`.
4.  **Migrate Database:**
    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```
5.  **Jalankan Server:**
    ```bash
    php artisan serve
    ```

---

## 🚀 Live Demo
**URL:** *[Coming Soon]*

## 📅 Status Project
✅ **Development Phase** (Fitur Utama Selesai, tahap Finalisasi)

---
**Last Update:** 1 Februari 2026
