# PKaltim Kuliner - Website Artikel Wisata Kuliner Kalimantan Timur

Website informatif untuk membahas berbagai kuliner khas Kalimantan Timur dengan fitur CRUD lengkap.

## 🛠️ Tech Stack

- **Backend:** FastAPI (Python)
- **Frontend:** Vue.js 3 + Vite
- **Database:** MySQL
- **ORM:** SQLAlchemy
- **Authentication:** JWT (JSON Web Tokens)

## 📋 Fitur

- ✅ CRUD lengkap untuk Artikel
- ✅ Upload gambar untuk artikel (featured image + gallery)
- ✅ Manajemen Kategori
- ✅ Login Admin dengan JWT
- ✅ Dashboard Admin
- ✅ UI Modern & Responsive
- ✅ Pagination & Filter

## 🚀 Setup & Instalasi

### Prerequisites

- Python 3.13+
- Node.js 18+
- MySQL 8.0+
- uv (Python package manager)

### 1. Setup Database

1. Import database ke phpMyAdmin:
   - Buka phpMyAdmin
   - Buat database baru: `pkaltim_kuliner`
   - Import file `database/pkaltim_kuliner.sql`

2. Atau jalankan SQL file langsung:
   ```sql
   mysql -u root -p < database/pkaltim_kuliner.sql
   ```

### 2. Setup Backend

```bash
# Install dependencies dengan uv
uv sync

# Atau dengan pip (jika tidak pakai uv)
pip install -r requirements.txt

# Copy file .env
cp backend/.env.example backend/.env

# Edit backend/.env dan sesuaikan konfigurasi database:
# DATABASE_URL=mysql+pymysql://root:password@localhost:3306/pkaltim_kuliner
# SECRET_KEY=your-secret-key-here

# Jalankan backend
uvicorn backend.main:app --reload
# atau
python main.py
```

Backend akan berjalan di `http://localhost:8000`

### 3. Setup Frontend

```bash
cd frontend

# Install dependencies
npm install

# Jalankan development server
npm run dev
```

Frontend akan berjalan di `http://localhost:5173`

### 4. Setup Admin User

Default admin user:
- **Username:** `admin`
- **Password:** `admin123` (harus diubah setelah login pertama!)

Untuk membuat user baru, gunakan endpoint:
```bash
POST /api/auth/register
{
  "username": "admin",
  "email": "admin@example.com",
  "password": "password123"
}
```

## 📁 Struktur Project

```
tim-03/
├── backend/
│   ├── main.py              # FastAPI app entry point
│   ├── database.py          # Database configuration
│   ├── models.py            # SQLAlchemy ORM models
│   ├── schemas.py           # Pydantic schemas
│   ├── auth.py              # Authentication utilities
│   ├── routes/
│   │   ├── auth.py          # Auth endpoints
│   │   ├── articles.py      # Article CRUD endpoints
│   │   └── categories.py    # Category CRUD endpoints
│   └── uploads/             # Uploaded images (auto-created)
├── frontend/
│   ├── src/
│   │   ├── api/             # API service files
│   │   ├── components/       # Vue components
│   │   ├── views/           # Vue pages
│   │   ├── router/          # Vue Router config
│   │   └── style.css        # Global styles
│   └── package.json
├── database/
│   └── pkaltim_kuliner.sql  # SQL dump file
└── README.md
```

## 🗄️ Database Schema

### Tables

1. **users** - Admin users
   - id, username, email, hashed_password, is_active

2. **categories** - Article categories
   - id, name, description

3. **articles** - Main articles
   - id, title, slug, content, excerpt, featured_image, category_id, author_id, is_published, views

4. **article_images** - Additional images for articles
   - id, article_id, image_path, alt_text, display_order

## 🔐 API Endpoints

### Authentication
- `POST /api/auth/login` - Login admin
- `GET /api/auth/me` - Get current user
- `POST /api/auth/register` - Register new user

### Articles
- `GET /api/articles/` - Get all articles (public)
- `GET /api/articles/admin` - Get all articles (admin)
- `GET /api/articles/{id}` - Get article by ID
- `GET /api/articles/slug/{slug}` - Get article by slug
- `POST /api/articles/` - Create article (auth required)
- `PUT /api/articles/{id}` - Update article (auth required)
- `DELETE /api/articles/{id}` - Delete article (auth required)
- `POST /api/articles/{id}/images` - Add image to article
- `DELETE /api/articles/images/{id}` - Delete article image

### Categories
- `GET /api/categories/` - Get all categories
- `GET /api/categories/{id}` - Get category by ID
- `POST /api/categories/` - Create category (auth required)
- `PUT /api/categories/{id}` - Update category (auth required)
- `DELETE /api/categories/{id}` - Delete category (auth required)

## 🎨 Halaman Website

### Public Pages
- `/` - Homepage dengan artikel terbaru
- `/articles` - Daftar semua artikel
- `/article/:slug` - Detail artikel

### Admin Pages (Login Required)
- `/login` - Halaman login
- `/admin` - Dashboard admin
- `/admin/articles` - Kelola artikel
- `/admin/articles/create` - Buat artikel baru
- `/admin/articles/edit/:id` - Edit artikel
- `/admin/categories` - Kelola kategori

## 🎯 Cara Menggunakan

1. **Login sebagai Admin:**
   - Buka `http://localhost:5173/login`
   - Login dengan username: `admin`, password: `admin123`

2. **Buat Kategori:**
   - Masuk ke `/admin/categories`
   - Klik "Tambah Kategori"
   - Isi nama dan deskripsi

3. **Buat Artikel:**
   - Masuk ke `/admin/articles`
   - Klik "Buat Artikel Baru"
   - Isi form: judul, kategori, konten
   - Upload featured image (opsional)
   - Publish atau simpan sebagai draft

4. **Tambah Gambar ke Artikel:**
   - Edit artikel yang sudah dibuat
   - Scroll ke bagian "Galeri Gambar"
   - Upload gambar tambahan

## 📝 Catatan Penting

- **Password Default:** Setelah import database, ubah password admin segera!
- **Upload Directory:** Folder `backend/uploads/` akan dibuat otomatis
- **CORS:** Backend sudah dikonfigurasi untuk menerima request dari frontend
- **Image Upload:** Gambar akan di-resize otomatis jika terlalu besar

## 🐛 Troubleshooting

### Database Connection Error
- Pastikan MySQL berjalan
- Cek kredensial di `backend/.env`
- Pastikan database `pkaltim_kuliner` sudah dibuat

### CORS Error
- Pastikan backend berjalan di port 8000
- Pastikan frontend berjalan di port 5173
- Cek konfigurasi CORS di `backend/main.py`

### Image Upload Error
- Pastikan folder `backend/uploads/images/` ada dan writable
- Cek permission folder

## 👥 Tim

1. Aurelyo Daffa Zaqwan Anwary
2. Muhammad Habibi Lhaksono
3. Muhammad Navies Ramadhan (PIC)

## 📄 License

MIT License

---

**Last Update:** 9 Januari 2026
