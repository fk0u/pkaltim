# 🍜 KulinerKaltim - Kuliner Khas Kalimantan Timur

> Platform informasi kuliner khas Kalimantan Timur yang memudahkan pengguna untuk mengeksplorasi dan berbagi pengalaman tentang makanan tradisional Kaltim.
---

## 📖 Tentang Proyek

**KulinerKaltim** adalah aplikasi web yang dikembangkan sebagai tugas Mini Project mata kuliah Basis Data. Aplikasi ini bertujuan untuk memberikan informasi kepada siapa saja yang berminat untuk melihat-lihat dan mengeksplorasi kuliner khas Kalimantan Timur.

Proyek ini dibangun menggunakan framework **Laravel** dengan **Tailwind CSS** untuk frontend, dan **MySQL (phpMyAdmin)** sebagai database management system.

---

## Flowchart alur kerja projek

![ini adalah gambar yang menjelaskan alur proses login admin ke dalam dashboard admin](./public/images/Whatsapp%20Image%202026-01-18%20at%2019.56.06.jpeg)

---

## Tentang Informasi Tambahan

Nama Guru: Hendra Yuni Irawan, S.T., M.Kom
Nama PC: Widhi Nur Maulida

## 👥 Tim Pengembang

| Nama | Username GitHub | Email | Role |
|------|----------------|-------|------|
| Nabila | [@nabila06](https://github.com/nabila06) | nabilahcahya066@gmail.com | Team Leader, Backend Developer |
| Diva Silviana | [@yoricia22](https://github.com/yoricia22) | divasilviana30@gmail.com | Frontend Developer, Backend Support |
| Asnia Amelia | [@asnia08](https://github.com/asnia08) | ameliaasnia@gmail.com | UI/UX Designer, Frontend Developer |

> **Note:** Pada awal pengembangan, terdapat beberapa commit dengan author "Your Name" (you@example.com) yang merupakan hasil kerja Nabila sebelum konfigurasi Git diatur dengan benar. Setelah konfigurasi diperbaiki, semua commit menggunakan username yang sesuai.

---

## 🚀 Fitur Utama

### 👤 Fitur User
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

---

## 📊 Progress Pengembangan

### Phase 1: Planning & Database
- [x] Perencanaan sistem
- [x] Database design & ERD
- [x] Migrasi database
- [x] Setup Laravel project
- [x] Setup Tailwind CSS

### Phase 2: Authentication & Authorization
- [x] User authentication (login/register)
- [x] Admin authentication
- [x] Role-based access control
- [x] Session management

### Phase 3: UI/UX Design
- [x] Design mockup aplikasi
- [x] User interface implementation
- [x] Responsive design

### Phase 4: Core Features (User Side)
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

### Phase 5: Admin Panel
- [x] Admin dashboard
- [x] CRUD kuliner
- [x] User management (ban/unban)
- [] Feedback management
- [x] Comment moderation

### Phase 6: Testing & Deployment
- [ ] Unit testing
- [ ] Integration testing
- [ ] Bug fixing
- [ ] Performance optimization
- [ ] Documentation
- [ ] Deployment

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 10.x
- **Language:** PHP 8.x
- **Database:** MySQL
- **Database Tool:** phpMyAdmin

### Frontend
- **CSS Framework:** Tailwind CSS
- **Template Engine:** Blade (Laravel)
- **JavaScript:** Vanilla JS / Alpine.js 

### Development Tools
- **Version Control:** Git & GitHub
- **Local Server:** XAMPP
- **Code Editor:** Visual Studio Code
- **Collaboration:** Git Branch & Pull Request workflow

---

## 📋 Instalasi & Setup

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- XAMPP
- Laragon
- Dbeaver
- Node.js & npm

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/yoricia22/KulinerKaltim.git
   cd KulinerKaltim
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   
   Edit file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kuliner
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrasi database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build assets**
   ```bash
   npm run dev
   ```

7. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

   Aplikasi dapat diakses di `http://localhost:8000` atau 'http://127.0.0.1:8000'

---

## 📁 Struktur Proyek

```
KulinerKaltim/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── routes/
│   └── web.php
├── .env
└── README.md
```

---

## 🎯 Metodologi Pengembangan

1. **Perencanaan**
   - Analisis kebutuhan sistem (oleh Nabila)
   - Pembuatan ERD dan database design
   - User story & use case

2. **Database Migration**
   - Setup struktur database (oleh Nabila)
   - Relasi antar tabel
   - Seeding data awal

3. **UI/UX Design**
   - Mockup design (oleh Asnia & Diva)
   - Prototype & wireframe
   - Design system

4. **Development**
   - Backend development (Nabila & Diva)
   - Frontend implementation (Diva & Asnia)
   - Integration & testing

5. **Testing & Deployment**
   - Testing functionality
   - Bug fixing
   - Final deployment

---

## 🤝 Kontribusi

Proyek ini dikembangkan oleh tim sebagai tugas Mini Project. Untuk saran dan masukan, silakan hubungi salah satu anggota tim melalui email yang tertera di atas.

---

## 📝 Catatan Pengembangan

### Challenges
- Koordinasi tim dalam penggunaan Git & GitHub
- Integrasi frontend-backend
- Implementasi role-based access control
- Google Maps API integration

### Lessons Learned
- Pentingnya konfigurasi Git yang benar sejak awal
- Komunikasi tim dalam development
- Version control best practices
- Laravel best practices & design patterns

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademik (Tugas Mini Project Basis Data).

---

## 📞 Kontak

Jika ada pertanyaan atau saran, silakan hubungi:
- **Asnia**: ameliaasnia@gmail.com
- **Diva**: divasilviana30@gmail.com
- **Nabila** nabilahcahya066@gmail.com

---
## tambahan informasi mengenai projek ini

## Informasi Tambahan
Untuk dokumentasi lengkap dan informasi detail proyek, silakan kunjungi:

[![Notion](https://img.shields.io/badge/Notion-000000?style=for-the-badge&logo=notion&logoColor=white)](https://www.notion.so/Mini-Web-Project-2ee05347ba0f80139ddad6327fbb08c5)

---

**© 2026 KulinerKaltim Team. Built with ❤️ for Kalimantan Timur's Culinary Heritage.**
