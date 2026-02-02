# 🍜 KulinerKaltim - Kuliner Khas Kalimantan Timur

> Platform informasi kuliner khas Kalimantan Timur yang memudahkan pengguna untuk mengeksplorasi dan berbagi pengalaman tentang makanan tradisional Kaltim.

---

## 📖 Tentang Proyek

**KulinerKaltim** adalah aplikasi web yang dikembangkan sebagai tugas Mini Project mata kuliah Basis Data. Aplikasi ini bertujuan untuk memberikan informasi kepada siapa saja yang berminat untuk melihat-lihat dan mengeksplorasi kuliner khas Kalimantan Timur.

Proyek ini dibangun menggunakan framework **Laravel** dengan **Tailwind CSS** untuk frontend, dan **MySQL (phpMyAdmin)** sebagai database management system.

---

## 📊 Flowchart Alur Kerja Projek

![Flowchart - Alur proses login admin ke dalam dashboard admin](./public/images/Whatsapp%20Image%202026-01-18%20at%2019.56.06.jpeg)

---

## 👨‍🏫 Informasi Pembimbing

- **Nama Guru:** Hendra Yuni Irawan, S.T., M.Kom
- **Nama PC:** Widhi Nur Maulida

---

## 👥 Tim Pengembang

| Nama | Username GitHub | Email | Role |
|------|----------------|-------|------|
| Nabila | [@nabila06](https://github.com/nabila06) | nabilahcahya066@gmail.com | Team Leader, Backend Developer |
| Diva Silviana | [@yoricia22](https://github.com/yoricia22) | divasilviana30@gmail.com | Frontend Developer, Backend Support |
| Asnia Amelia | [@asnia08](https://github.com/asnia08) | ameliaasnia@gmail.com | UI/UX Designer, Frontend Developer |

> **Note:** Pada awal pengembangan, terdapat beberapa commit dengan author "Your Name" (you@example.com) yang merupakan hasil kerja Nabila sebelum konfigurasi Git diatur dengan benar. Setelah konfigurasi diperbaiki, semua commit menggunakan username yang sesuai.

---

## 🚀 Fitur Utama

### 👤 Fitur User (Public)
- ✅ Melihat daftar kuliner khas Kaltim
- ✅ Melihat detail makanan
- ✅ Add to Favorites
- ✅ Memberikan rating pada kuliner
- ✅ Memberikan komentar
- ✅ Like komentar user lain
- ✅ Integrasi Google Maps untuk lokasi kuliner
- ✅ Sorting berdasarkan kategori
- ✅ Search/Pencarian kuliner

### 🔧 Fitur Admin
- ✅ Authentication & Authorization
- ✅ CRUD Kuliner (Create, Read, Update, Delete)
- ✅ Manage Feedback dari user
- ✅ Manage Ulasan
- ✅ Dashboard monitoring
- ✅ User management (ban/unban)

---

## 📊 Progress Pengembangan

### Phase 1: Planning & Database ✅
- [x] Perencanaan sistem
- [x] Database design & ERD
- [x] Migrasi database
- [x] Setup Laravel project
- [x] Setup Tailwind CSS

### Phase 2: Authentication & Authorization ✅
- [x] Admin authentication
- [x] Role-based access control
- [x] Session management

### Phase 3: UI/UX Design ✅
- [x] Design mockup aplikasi
- [x] User interface implementation
- [x] Responsive design

### Phase 4: Core Features (User Side) ✅
- [x] Homepage & landing page
- [x] Daftar kuliner
- [x] Detail kuliner
- [x] Favorites system
- [x] Rating system
- [x] Comment system
- [x] Like comment feature
- [x] Google Maps integration
- [x] Search & filter kuliner
- [x] Category sorting

### Phase 5: Admin Panel ✅
- [x] Admin dashboard
- [x] CRUD kuliner
- [x] User management (ban/unban)
- [x] Feedback management
- [x] Comment moderation

### Phase 6: Testing & Deployment 🔄
- [ ] Unit testing
- [ ] Integration testing
- [ ] Bug fixing
- [ ] Performance optimization
- [x] Documentation
- [ ] Deployment

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 10.x
- **Language:** PHP 8.x
- **Database:** MySQL
- **Database Tool:** phpMyAdmin / DBeaver

### Frontend
- **CSS Framework:** Tailwind CSS
- **Template Engine:** Blade (Laravel)
- **JavaScript:** Vanilla JS / Alpine.js 

### Development Tools
- **Version Control:** Git & GitHub
- **Local Server:** XAMPP / Laragon
- **Code Editor:** Visual Studio Code
- **Collaboration:** Git Branch & Pull Request workflow

---

## 📋 Instalasi & Setup

### Prerequisites
Pastikan sudah terinstall:
- ✅ PHP >= 8.0
- ✅ Composer
- ✅ MySQL
- ✅ XAMPP / Laragon
- ✅ Node.js & npm (untuk Tailwind CSS)
- ✅ Git

---

### 🚀 Langkah Instalasi

#### 1️⃣ Clone Repository
```bash
git clone https://github.com/yoricia22/KulinerKaltim.git
cd KulinerKaltim
```

#### 2️⃣ Install Dependencies

**Install Composer dependencies:**
```bash
composer install
```

**Install NPM dependencies:**
```bash
npm install
```

#### 3️⃣ Setup Environment

**Copy file .env.example:**
```bash
cp .env.example .env
```

**Generate application key:**
```bash
php artisan key:generate
```

#### 4️⃣ Konfigurasi Database

**Edit file `.env`** dan sesuaikan dengan database lokal Anda:
```env
APP_NAME=KulinerKaltim
APP_ENV=local
APP_KEY=base64:... # sudah di-generate otomatis
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kuliner
DB_USERNAME=root
DB_PASSWORD=
```

#### 5️⃣ Buat Database

Buka **phpMyAdmin** atau **MySQL CLI**, lalu buat database:
```sql
CREATE DATABASE kuliner;
```

#### 6️⃣ Migrasi & Seeding Database

**Jalankan migrasi untuk membuat tabel:**
```bash
php artisan migrate
```

**Jalankan seeder untuk mengisi data dummy:**
```bash
php artisan db:seed
```

> **Catatan:** Database seeder akan otomatis membuat:
> - Data admin default
> - Data kuliner contoh
> - Data kategori kuliner
> - Data user dummy (untuk testing)

#### 7️⃣ Build Assets (Tailwind CSS)

**Development mode:**
```bash
npm run dev
```

**Production mode:**
```bash
npm run build
```

#### 8️⃣ Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi dapat diakses di:
- **URL Utama:** `http://localhost:8000` atau `http://127.0.0.1:8000`
- **Admin Login:** `http://localhost:8000/admin/login`

---

## 🔑 Default Login Credentials

### 👨‍💼 Admin
Untuk mengakses panel admin, gunakan kredensial berikut:

**URL Login:** `http://localhost:8000/admin/login`

| Email | Password | Role |
|-------|----------|------|
| `admin@kulinerkaltim.com` | `admin123` | Super Admin |

> **Penting:** Tidak ada sistem registrasi untuk admin. Admin hanya dapat dibuat melalui seeder atau manual di database.

### 👤 User Public
User umum **tidak memerlukan login** untuk:
- Melihat daftar kuliner
- Melihat detail kuliner
- Menggunakan fitur search & filter
- Add to Favorites
- Memberikan rating
- Menulis komentar
- Like komentar

---

## 📁 Struktur Database

### Tabel Utama:
- `users` - Data pengguna (admin dan user)
- `kuliners` - Data kuliner khas Kaltim
- `categories` - Kategori kuliner
- `ratings` - Rating dari user
- `comments` - Komentar user
- `favorites` - Kuliner favorit user
- `feedbacks` - Feedback dari user

### Relasi Database:
- User memiliki banyak favorites, ratings, comments
- Kuliner memiliki banyak ratings, comments, favorites
- Kuliner belongs to category

---

## 📁 Struktur Proyek

```
KulinerKaltim/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── KulinerController.php
│   │   │   ├── UserController.php
│   │   │   └── ...
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Kuliner.php
│   │   ├── Category.php
│   │   └── ...
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_kuliners_table.php
│   │   └── ...
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminSeeder.php
│       ├── KulinerSeeder.php
│       └── ...
├── public/
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   ├── user/
│   │   └── layouts/
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   └── web.php
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 🎯 Metodologi Pengembangan

### 1. Perencanaan
- Analisis kebutuhan sistem (oleh Nabila)
- Pembuatan ERD dan database design
- User story & use case

### 2. Database Migration
- Setup struktur database (oleh Nabila)
- Relasi antar tabel
- Seeding data awal

### 3. UI/UX Design
- Mockup design (oleh Asnia & Diva)
- Prototype & wireframe
- Design system

### 4. Development
- Backend development (Nabila & Diva)
- Frontend implementation (Diva & Asnia)
- Integration & testing

### 5. Testing & Deployment
- Testing functionality
- Bug fixing
- Final deployment

---

## 🐛 Troubleshooting

### Error: "SQLSTATE[HY000] [1049] Unknown database"
**Solusi:** Pastikan database `kuliner` sudah dibuat di phpMyAdmin/MySQL

### Error: "Class 'App\...' not found"
**Solusi:** Jalankan `composer dump-autoload`

### Error: Tailwind CSS tidak muncul
**Solusi:** 
```bash
npm run dev
# atau
npm run build
```

### Error: "No application encryption key has been specified"
**Solusi:** Jalankan `php artisan key:generate`

### Port 8000 sudah digunakan
**Solusi:** Gunakan port lain
```bash
php artisan serve --port=8001
```

---

## 🤝 Kontribusi

Proyek ini dikembangkan oleh tim sebagai tugas Mini Project. Untuk saran dan masukan, silakan hubungi salah satu anggota tim melalui email yang tertera di atas.

---

## 📝 Catatan Pengembangan

### Challenges
- ✅ Koordinasi tim dalam penggunaan Git & GitHub
- ✅ Integrasi frontend-backend
- ✅ Implementasi role-based access control
- ✅ Google Maps API integration

### Lessons Learned
- ✅ Pentingnya konfigurasi Git yang benar sejak awal
- ✅ Komunikasi tim dalam development
- ✅ Version control best practices
- ✅ Laravel best practices & design patterns

---

## 📚 Dokumentasi Lengkap

Untuk dokumentasi lengkap dan informasi detail proyek, silakan kunjungi:

[![Notion](https://img.shields.io/badge/Notion-000000?style=for-the-badge&logo=notion&logoColor=white)](https://www.notion.so/Mini-Web-Project-2ee05347ba0f80139ddad6327fbb08c5)

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik (Tugas Mini Project Basis Data).

---

## 📞 Kontak

Jika ada pertanyaan atau saran, silakan hubungi:

| Nama | Email |
|------|-------|
| **Nabila** | nabilahcahya066@gmail.com |
| **Diva Silviana** | divasilviana30@gmail.com |
| **Asnia Amelia** | ameliaasnia@gmail.com |

---

## 🏆 Acknowledgments

Terima kasih kepada:
- **Bapak Hendra Yuni Irawan, S.T., M.Kom** - Pembimbing proyek
- **Widhi Nur Maulida** - PC pendamping
- Seluruh anggota tim yang telah bekerja sama dengan baik
- Komunitas Laravel Indonesia

---

**© 2026 KulinerKaltim Team. Built with ❤️ for Kalimantan Timur's Culinary Heritage.**

---

## 🔖 Tech Badges

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.x-blue?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?style=for-the-badge&logo=mysql)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![Status](https://img.shields.io/badge/Status-Active-success?style=for-the-badge)
