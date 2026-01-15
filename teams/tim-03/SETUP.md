# 🚀 Panduan Setup Project PKaltim Kuliner

## Langkah-langkah Setup

### 1. Setup Database MySQL

1. Buka phpMyAdmin atau MySQL client
2. Buat database baru dengan nama: `pkaltim_kuliner`
3. Import file SQL:
   - Buka phpMyAdmin
   - Pilih database `pkaltim_kuliner`
   - Klik tab "Import"
   - Pilih file `database/pkaltim_kuliner.sql`
   - Klik "Go"

**Atau via command line:**
```bash
mysql -u root -p pkaltim_kuliner < database/pkaltim_kuliner.sql
```

### 2. Setup Backend (FastAPI)

```bash
# Masuk ke folder project
cd pkaltim/teams/tim-03

# Install dependencies dengan uv (recommended)
uv sync

# Atau install dengan pip
pip install -r backend/requirements.txt

# Copy file environment
cp backend/.env.example backend/.env

# Edit backend/.env dan sesuaikan:
# DATABASE_URL=mysql+pymysql://root:password@localhost:3306/pkaltim_kuliner
# SECRET_KEY=ubah-ini-dengan-random-string-panjang
```

**Jalankan Backend:**
```bash
# Dari root project
uvicorn backend.main:app --reload

# Atau
python main.py
```

Backend akan berjalan di: `http://localhost:8000`
API Docs: `http://localhost:8000/docs`

### 3. Setup Frontend (Vue.js)

```bash
# Masuk ke folder frontend
cd frontend

# Install dependencies
npm install

# Jalankan development server
npm run dev
```

Frontend akan berjalan di: `http://localhost:5173`

### 4. Login Pertama Kali

1. Buka `http://localhost:5173/login`
2. Login dengan:
   - **Username:** `admin`
   - **Password:** `admin123`

⚠️ **PENTING:** Segera ubah password setelah login pertama!

## 🔧 Konfigurasi Database

Edit file `backend/.env`:

```env
# Database Configuration
DATABASE_URL=mysql+pymysql://root:@localhost:3306/pkaltim_kuliner

# Jika MySQL punya password:
DATABASE_URL=mysql+pymysql://root:password@localhost:3306/pkaltim_kuliner

# JWT Secret Key (ubah dengan random string!)
SECRET_KEY=your-secret-key-change-this-in-production
ACCESS_TOKEN_EXPIRE_MINUTES=30
```

## 📝 Struktur Folder Upload

Folder `backend/uploads/images/` akan dibuat otomatis saat pertama kali upload gambar.

Jika folder tidak terbuat otomatis, buat manual:
```bash
mkdir -p backend/uploads/images
```

## ✅ Verifikasi Setup

1. **Backend berjalan:**
   - Buka `http://localhost:8000/docs`
   - Harus muncul Swagger UI

2. **Frontend berjalan:**
   - Buka `http://localhost:5173`
   - Harus muncul homepage

3. **Database terhubung:**
   - Coba login di frontend
   - Jika berhasil, database sudah OK

## 🐛 Troubleshooting

### Error: "Module not found"
```bash
# Pastikan install semua dependencies
uv sync
# atau
pip install -r backend/requirements.txt
```

### Error: "Can't connect to MySQL"
- Pastikan MySQL service berjalan
- Cek username/password di `.env`
- Pastikan database `pkaltim_kuliner` sudah dibuat

### Error: "CORS policy"
- Pastikan backend berjalan di port 8000
- Pastikan frontend berjalan di port 5173
- Cek konfigurasi CORS di `backend/main.py`

### Error: "Image upload failed"
- Pastikan folder `backend/uploads/images/` ada
- Cek permission folder (harus writable)

## 📚 Next Steps

Setelah setup selesai:
1. Login sebagai admin
2. Buat kategori baru di `/admin/categories`
3. Buat artikel pertama di `/admin/articles/create`
4. Upload gambar untuk artikel
5. Publish artikel

Selamat coding! 🎉
