# 📋 Panduan Pengumpulan Tugas Mini Project

> **Deadline:** 5 Februari 2026 (Pukul 23:59 WITA)  
> **Repository:** https://github.com/fk0u/pkaltim  
> **Koordinator:** Navies, Ghani, Widhi

---

## 🚨 ATURAN PENTING - WAJIB DIBACA!

### ❌ LARANGAN KERAS

#### 1. **DILARANG VIBE CODING**
Vibe coding adalah **coding tanpa paham** yang dilakukan dengan:
- ❌ Copy-paste code tanpa tahu cara kerjanya
- ❌ Pakai template/framework tanpa bisa explain
- ❌ Asal jalan tanpa paham logikanya
- ❌ Ikut tutorial tapi gak ngerti isinya

**KONSEKUENSI:** Nilai dikurangi atau diskualifikasi jika tidak bisa menjelaskan kode sendiri saat ditanya!

#### 2. **DILARANG SEPENUHNYA PAKAI AI**
AI boleh dipakai sebagai **ALAT BANTU**, BUKAN pengganti belajar:
- ✅ **BOLEH:** Tanya konsep ke ChatGPT/Copilot
- ✅ **BOLEH:** Minta saran untuk fix bug
- ✅ **BOLEH:** Generate boilerplate code sederhana
- ❌ **DILARANG:** Minta AI bikin project dari A-Z
- ❌ **DILARANG:** Copy full code AI tanpa modifikasi
- ❌ **DILARANG:** Serahkan semua tugas ke AI

**KONSEKUENSI:** Akan ada sesi tanya jawab/presentasi. Jika tidak bisa jelaskan kode = **NILAI 0**!

#### 3. **WAJIB PAHAM CODE SENDIRI**
- ✅ Setiap anggota tim harus paham keseluruhan project
- ✅ Bisa jelaskan setiap fungsi yang dibuat
- ✅ Bisa jawab pertanyaan tentang kode
- ✅ Siap demo langsung tanpa script

**TIPS BELAJAR:**
```
1. Baca code baris per baris
2. Tulis komentar di tiap fungsi
3. Coba ubah value, lihat hasilnya
4. Diskusi bareng tim
5. Tanya PIC kalau bingung
```

---

## 📝 Cara Pengumpulan (Step-by-Step)

### 📍 **TIDAK PERLU HOSTING/DEPLOYMENT**
Tugas cukup di-upload ke GitHub saja. Hosting **OPSIONAL** (bonus).

---

## 🌟 Untuk Pemula GitHub (Belum Pernah Pakai Git)

### Step 1: Install Git
```bash
# Cek apakah sudah ada git
git --version

# Kalau belum ada, install:
# Windows: Download di https://git-scm.com/download/win
# Linux: sudo apt install git
# Mac: brew install git
```

### Step 2: Setup Git (Sekali Saja)
```bash
# Isi dengan nama dan email kamu
git config --global user.name "Nama Kamu"
git config --global user.email "email@example.com"
```

### Step 3: Buat Akun GitHub
1. Buka https://github.com
2. Klik **Sign Up**
3. Isi username, email, password
4. Verifikasi email

---

## 📂 Cara Upload Project ke GitHub (Lengkap)

### Cara 1: Pakai Terminal/CMD (Direkomendasikan)

#### 📥 **Langkah 1: Fork Repository (Sekali Saja)**

1. Buka: https://github.com/fk0u/pkaltim
2. Klik tombol **Fork** (pojok kanan atas)
3. Pilih akun kamu
4. Tunggu sampai selesai (repo akan muncul di akun kamu)

#### 💾 **Langkah 2: Clone ke Komputer**

```bash
# Ganti "username-kamu" dengan username GitHub kamu
git clone https://github.com/username-kamu/pkaltim.git

# Masuk ke folder project
cd pkaltim
```

#### 📝 **Langkah 3: Kerjakan Project**

```bash
# Masuk ke folder tim kamu (contoh: tim-04)
cd teams/tim-04

# Buat file-file project kamu disini
# Contoh struktur:
# teams/tim-04/
# ├── index.php
# ├── config.php
# ├── public/
# ├── admin/
# └── database/
```

**WAJIB:** Update file `README.md` di folder tim kamu dengan:
- Nama anggota tim
- Deskripsi project
- Fitur yang dibuat
- Cara instalasi
- Screenshot (bonus)

#### 📤 **Langkah 4: Upload ke GitHub**

```bash
# Kembali ke root folder project
cd /path/to/pkaltim

# Cek status file (lihat file apa saja yang berubah)
git status

# Tambahkan semua file baru/perubahan
git add .

# Atau tambah file tertentu saja:
# git add teams/tim-04/index.php

# Commit dengan pesan yang jelas
git commit -m "Tim 04: Menambahkan halaman utama dan dashboard admin"

# Upload ke GitHub
git push origin main
```

**TIPS COMMIT MESSAGE:**
```bash
✅ BAGUS:
git commit -m "Tim 04: Menambahkan fitur CRUD wisata alam"
git commit -m "Tim 04: Fix bug pada form login"
git commit -m "Tim 04: Update database schema"

❌ BURUK:
git commit -m "update"
git commit -m "fix"
git commit -m "aaaaaa"
```

#### 🔄 **Langkah 5: Update Progress di GitHub**

Setiap kali ada kemajuan, update di file `docs/progress.md`:

```bash
# Edit file docs/progress.md
# Ubah status tim kamu

git add docs/progress.md
git commit -m "Tim 04: Update progress - selesai fitur CRUD"
git push origin main
```

#### 🚀 **Langkah 6: Buat Pull Request (PR)**

1. Buka repository kamu di GitHub: `https://github.com/username-kamu/pkaltim`
2. Klik tombol **Pull Request** atau **Contribute**
3. Klik **Open Pull Request**
4. Isi judul PR: `[Tim XX] Nama Fitur/Update`
5. Isi deskripsi PR dengan checklist yang sudah disediakan
6. Klik **Create Pull Request**

**Contoh Judul PR:**
```
✅ [Tim 04] Submission: Wisata Alam Kaltim
✅ [Tim 04] Update: Menambahkan fitur pencarian
✅ [Tim 04] Fix: Perbaikan bug login
```

---

### Cara 2: Pakai GitHub Desktop (Lebih Mudah)

#### 📥 **Install GitHub Desktop**
1. Download: https://desktop.github.com
2. Install dan login dengan akun GitHub

#### 🔧 **Langkah-Langkah:**

1. **Fork Repository** (di website GitHub)
   - Buka: https://github.com/fk0u/pkaltim
   - Klik **Fork**

2. **Clone di GitHub Desktop**
   - Buka GitHub Desktop
   - File → Clone Repository
   - Pilih `username-kamu/pkaltim`
   - Pilih lokasi folder
   - Klik **Clone**

3. **Kerjakan Project**
   - Buka folder `teams/tim-XX`
   - Buat file-file project kamu

4. **Commit Changes**
   - GitHub Desktop akan deteksi perubahan otomatis
   - Tulis commit message di bawah
   - Klik **Commit to main**

5. **Push ke GitHub**
   - Klik **Push origin** (tombol atas)

6. **Buat Pull Request**
   - Klik **Create Pull Request** di GitHub Desktop
   - Atau buka website GitHub, klik **Pull Request**

---

### Cara 3: Upload Langsung via GitHub Web (Tidak Direkomendasikan)

**CATATAN:** Cara ini hanya untuk file kecil, **tidak praktis untuk project besar**.

1. **Fork Repository**
   - Buka: https://github.com/fk0u/pkaltim
   - Klik **Fork**

2. **Upload File**
   - Masuk ke folder `teams/tim-XX`
   - Klik **Add File** → **Upload Files**
   - Drag & drop file kamu
   - Isi commit message
   - Klik **Commit Changes**

3. **Buat Pull Request**
   - Klik tab **Pull Requests**
   - Klik **New Pull Request**
   - Isi judul dan deskripsi
   - Klik **Create Pull Request**

---

## 📋 Checklist Sebelum Submit

### ✅ Persiapan Project
- [ ] Semua file sudah di folder `teams/tim-XX/`
- [ ] File `README.md` di folder tim sudah diisi lengkap
- [ ] Database file (`.sql`) sudah di folder `database/`
- [ ] Tidak ada file sampah (`.DS_Store`, `node_modules/`, dll)
- [ ] Kode sudah diberi komentar yang jelas

### ✅ Fitur Wajib
- [ ] Homepage dengan informasi wisata Kaltim
- [ ] Minimal 5 data wisata sesuai subtema
- [ ] Fitur pencarian/filter
- [ ] Admin panel (login + CRUD)
- [ ] Database terstruktur dengan relasi

### ✅ GitHub
- [ ] Repository sudah di-fork ke akun pribadi
- [ ] File sudah di-push ke GitHub
- [ ] Progress di `docs/progress.md` sudah diupdate
- [ ] Pull Request sudah dibuat dengan judul jelas
- [ ] Deskripsi PR sudah diisi lengkap

### ✅ Tim
- [ ] Semua anggota tim **PAHAM** seluruh kode
- [ ] Setiap anggota bisa **JELASKAN** fungsi yang dibuat
- [ ] Siap untuk sesi **TANYA JAWAB** dengan PIC
- [ ] Tidak ada anggota yang vibe coding

### ✅ Dokumentasi
- [ ] README.md berisi cara instalasi
- [ ] Screenshot aplikasi (bonus)
- [ ] Daftar fitur yang dibuat
- [ ] Pembagian tugas per anggota (bonus)

---

## 🎯 Format Pull Request

### Judul PR:
```
[Tim XX] Submission: [Subtema Wisata]
```

**Contoh:**
```
[Tim 04] Submission: Wisata Alam Kalimantan Timur
[Tim 07] Submission: Wisata Budaya dan Kuliner Kaltim
```

### Template Deskripsi PR:

```markdown
## 🎯 Informasi Tim

**Nama Tim:** Tim XX  
**Anggota:**
1. Nama 1 (NIS) - @username_github
2. Nama 2 (NIS) - @username_github  
3. Nama 3 (NIS) - @username_github

**PIC:** Navies / Ghani / Widhi  
**Subtema:** [Tuliskan subtema wisata yang dipilih]

---

## 📝 Deskripsi Project

[Jelaskan singkat tentang website yang dibuat, fokus tema apa, fitur apa saja]

**Contoh:**
> Website ini menampilkan informasi wisata alam di Kalimantan Timur seperti Pulau Derawan, Danau Labuan Cermin, dan taman nasional. Pengunjung bisa mencari wisata berdasarkan kategori dan lokasi. Admin bisa menambah, edit, dan hapus data wisata.

---

## ✨ Fitur yang Dibuat

- [ ] Homepage dengan hero section
- [ ] Halaman daftar wisata (grid/list view)
- [ ] Halaman detail wisata
- [ ] Fitur pencarian
- [ ] Filter berdasarkan kategori
- [ ] Admin login page
- [ ] Admin dashboard
- [ ] CRUD data wisata (Create, Read, Update, Delete)
- [ ] Database dengan minimal 3 tabel
- [ ] Responsive design (mobile-friendly)
- [ ] [Fitur bonus lainnya...]

---

## 🛠️ Tech Stack

**Backend:**
- PHP Native / Laravel / CodeIgniter / [lainnya]

**Database:**
- MySQL / PostgreSQL / [lainnya]

**Frontend:**
- HTML, CSS, JavaScript
- Bootstrap 5 / Tailwind / [lainnya]

**Tools:**
- XAMPP / Laragon / Docker / [lainnya]

---

## 📦 Cara Instalasi

```bash
# 1. Clone repository
git clone https://github.com/username/pkaltim.git
cd pkaltim/teams/tim-XX

# 2. Import database
# Buka phpMyAdmin
# Buat database baru: pkaltim_timXX
# Import file: database/pkaltim_timXX.sql

# 3. Konfigurasi database
# Edit file config.php
# Sesuaikan username, password, database name

# 4. Jalankan di browser
http://localhost/pkaltim/teams/tim-XX/
```

**Login Admin:**
- Username: [isi disini]
- Password: [isi disini]

---

## 📸 Screenshot

[Upload screenshot aplikasi - opsional tapi bagus untuk nilai bonus]

1. Homepage
2. Halaman Daftar Wisata
3. Detail Wisata
4. Admin Dashboard
5. Form CRUD

---

## 👥 Pembagian Tugas

| Nama | Tugas | Kontribusi |
|------|-------|-----------|
| Nama 1 | Frontend (Homepage, UI/UX) | 33% |
| Nama 2 | Backend (CRUD, Database) | 34% |
| Nama 3 | Admin Panel, Testing | 33% |

---

## ✅ Checklist Submission

- [x] Fork repository pkaltim
- [x] Buat struktur project di `teams/tim-XX/`
- [x] Implementasi fitur wajib
- [x] Testing di local (XAMPP/Laragon)
- [x] Update README.md
- [x] Push ke GitHub
- [x] Update progress di `docs/progress.md`
- [x] Buat Pull Request ini

---

## 🚨 Pernyataan

Kami menyatakan bahwa:
- ✅ Semua kode ditulis dan dipahami oleh tim
- ✅ AI hanya digunakan sebagai alat bantu belajar
- ✅ Setiap anggota siap menjelaskan kode yang dibuat
- ✅ Tidak ada vibe coding atau copy-paste tanpa paham
- ✅ Siap untuk sesi tanya jawab dengan PIC

**Tanda Tangan Digital:**
- [Nama 1] - Setuju ✅
- [Nama 2] - Setuju ✅
- [Nama 3] - Setuju ✅

---

## 📞 Kontak

Jika ada pertanyaan, hubungi PIC:
- **Navies** - [kontak]
- **Ghani** - [kontak]
- **Widhi** - [kontak]
```

---

## 🔄 Update Progress Berkala

**WAJIB** update progress minimal **2x seminggu** di `docs/progress.md`:

```markdown
### Tim XX - [Subtema Wisata]

**Status:** 🟢 On Track / 🟡 Butuh Bantuan / 🔴 Terlambat

**Progress:**
- [x] Setup project structure
- [x] Design database schema
- [x] Buat halaman homepage
- [ ] Implementasi CRUD
- [ ] Testing & debugging

**Kendala:**
[Tuliskan kendala yang dihadapi, kalau ada]

**Next Steps:**
[Tuliskan rencana minggu depan]

**Last Update:** [Tanggal]
```

---

## ❓ Troubleshooting GitHub

### Problem 1: `Permission denied (publickey)`
**Solusi:**
```bash
# Setup SSH key
ssh-keygen -t ed25519 -C "your_email@example.com"

# Copy SSH key
cat ~/.ssh/id_ed25519.pub

# Paste di GitHub: Settings → SSH Keys → New SSH Key
```

Atau pakai HTTPS instead:
```bash
git clone https://github.com/username/pkaltim.git
```

### Problem 2: `git push` tidak bisa
**Solusi:**
```bash
# Cek remote
git remote -v

# Update remote jika salah
git remote set-url origin https://github.com/username-kamu/pkaltim.git

# Coba push lagi
git push origin main
```

### Problem 3: Conflict saat push
**Solusi:**
```bash
# Pull dulu sebelum push
git pull origin main

# Jika ada conflict, resolve manual di file
# Setelah selesai:
git add .
git commit -m "Resolve conflict"
git push origin main
```

### Problem 4: Lupa password GitHub
**Solusi:**
- Reset password di: https://github.com/password_reset
- Pakai Personal Access Token (PAT) bukan password

**Cara buat PAT:**
1. GitHub → Settings → Developer Settings
2. Personal Access Tokens → Generate new token
3. Pilih scope: `repo` (full control)
4. Copy token, simpan (ga bisa dilihat lagi!)
5. Pakai token sebagai password saat `git push`

---

## 📞 Bantuan & Support

### Jika Ada Masalah:

1. **Masalah Teknis (Code/Git)**
   - Buat **GitHub Issue** di repo pkaltim
   - Tag PIC kamu
   - Jelaskan masalahnya dengan detail + screenshot

2. **Masalah Konsep/Pemahaman**
   - Tanya langsung ke PIC kamu:
     - **Navies:** Tim 1, 3, 6, 9
     - **Ghani:** Tim 4, 5, 8, 10
     - **Widhi:** Tim 2, 7, 11, 12

3. **Darurat/Deadline**
   - Hubungi PIC via WhatsApp
   - Atau Discord server (jika ada)

---

## 🎁 Bonus Points

Fitur tambahan yang bisa nambah nilai:

- ✨ **Responsive Design** - Mobile friendly (bonus +5)
- ✨ **Search & Filter** - Advanced filtering (bonus +3)
- ✨ **Rating/Review** - User bisa kasih rating (bonus +5)
- ✨ **Maps Integration** - Google Maps lokasi wisata (bonus +7)
- ✨ **Image Gallery** - Lightbox/carousel gambar (bonus +3)
- ✨ **Export Data** - Export ke PDF/Excel (bonus +5)
- ✨ **Email Notification** - Email ke admin (bonus +5)
- ✨ **Charts/Statistics** - Data visualization (bonus +5)
- ✨ **Deploy Online** - Hosting ke Netlify/Vercel/InfinityFree (bonus +10)
- ✨ **API Integration** - Weather API, etc (bonus +7)
- ✨ **Progressive Web App (PWA)** - Install seperti app (bonus +10)

**Maksimal bonus:** +20 poin

---

## ⚠️ Hal yang Harus Dihindari

### 🚫 Jangan Lakukan Ini:

1. ❌ **Push file besar** (video, .zip besar)
   - Gunakan `.gitignore` untuk exclude file besar

2. ❌ **Push credential/password**
   - Jangan commit file `config.php` dengan password asli
   - Gunakan environment variable atau `.env` (dan `.gitignore`)

3. ❌ **Commit pesan tidak jelas**
   - ❌ "update", "fix", "coba", "test"
   - ✅ "Tim 04: Tambah fitur filter kategori"

4. ❌ **Push ke branch main orang lain**
   - Selalu pastikan push ke **fork kamu sendiri**

5. ❌ **Copy code tanpa paham**
   - Bakal ketahuan saat sesi tanya jawab!

6. ❌ **Vibe coding sampai deadline**
   - Mulai dari sekarang, jangan prokrastinasi!

---

## 📚 Resource Belajar

### Git & GitHub:
- [Git Tutorial - Bahasa Indonesia](https://www.youtube.com/watch?v=lTMZxWMjXQU)
- [GitHub Docs](https://docs.github.com/en)
- [Git Cheat Sheet](https://education.github.com/git-cheat-sheet-education.pdf)

### PHP & MySQL:
- [PHP Manual](https://www.php.net/manual/en/)
- [W3Schools PHP](https://www.w3schools.com/php/)
- [MySQL Tutorial](https://www.mysqltutorial.org/)

### Frontend:
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.3/)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [MDN Web Docs](https://developer.mozilla.org/)

### YouTube Channels:
- Web Programming UNPAS
- Programmer Zaman Now
- Sandhika Galih

---

## 🎯 Timeline Pengerjaan (Rekomendasi)

| Minggu | Target | Deadline |
|--------|--------|----------|
| **Week 1** (9-15 Jan) | Setup + Design Database | 15 Jan |
| **Week 2** (16-22 Jan) | Homepage + Frontend | 22 Jan |
| **Week 3** (23-29 Jan) | CRUD + Admin Panel | 29 Jan |
| **Week 4** (30 Jan - 5 Feb) | Testing + Debugging + Submit | **5 Feb** |

**Jangan tunggu deadline!** Mulai dari sekarang! 🚀

---

## ✅ Final Checklist Before Deadline

### Satu Hari Sebelum Deadline:

- [ ] Testing full aplikasi (semua fitur jalan)
- [ ] Fix semua bug yang ditemukan
- [ ] Cek responsive di HP/tablet
- [ ] README.md lengkap dan rapi
- [ ] Database `.sql` bisa di-import tanpa error
- [ ] Screenshot aplikasi sudah di-upload
- [ ] Commit message rapi dan jelas
- [ ] Pull Request sudah dibuat
- [ ] Progress di `docs/progress.md` sudah 100%
- [ ] Semua anggota tim **PAHAM** seluruh kode

### Malam Deadline:

- [ ] Review Pull Request sekali lagi
- [ ] Pastikan tidak ada conflict
- [ ] Cek apakah PR sudah masuk ke repository utama
- [ ] Screenshot PR sebagai bukti submit
- [ ] Konfirmasi ke PIC bahwa sudah submit

---

## 🏆 Kriteria Penilaian

| Aspek | Bobot | Deskripsi |
|-------|-------|-----------|
| **Fungsionalitas** | 30% | Semua fitur berjalan dengan baik |
| **Kualitas Kode** | 20% | Clean code, terstruktur, ada komentar |
| **Database Design** | 15% | Schema terstruktur, relasi benar |
| **UI/UX Design** | 15% | Tampilan menarik, user-friendly |
| **Dokumentasi** | 10% | README lengkap, jelas |
| **GitHub Usage** | 10% | Commit teratur, PR rapi |
| **Pemahaman** | ⭐ | **Bisa jelaskan kode = lulus, ga bisa = gagal** |
| **Bonus** | +20% | Fitur tambahan, deploy, dll |

**TOTAL:** 100% + Bonus hingga 20%

---

## 🎉 Selamat Mengerjakan!

**Ingat:**
- 🧠 **PAHAM** lebih penting dari sekadar jalan
- 💬 **TANYA** kalau bingung, jangan malu
- 🤝 **KERJASAMA** antar tim, saling bantu
- 📅 **KONSISTEN** kerjakan berkala, jangan SKS (Sistem Kebut Semalam)
- 🎯 **FOKUS** ke pembelajaran, bukan cuma nilai

---

<div align="center">

**📌 Simpan panduan ini dan baca berkala! 📌**

**Good luck, Tim! Kalian pasti bisa! 💪🚀**

**#PKAltim2026 #SMKN7Samarinda #XIIPPLG1**

</div>

---

**Dibuat oleh:** Navies, Ghani, Widhi  
**Terakhir diupdate:** 8 Januari 2026  
**Kajur:** Bapak Hendra Yuni Irawan, S.T., M.Kom

