# GaleriKita — CRUD Galeri Gambar
**Tugas Sistem Multimedia | Kelompok 4IA07 | Universitas Gunadarma**

## Tech Stack
- **Backend**: PHP + CodeIgniter 3
- **Database**: MySQL
- **Frontend**: CSS3 (custom, Pinterest-style) + Vanilla JS

## Fitur
- ✅ Upload gambar (JPG, PNG, GIF, WEBP — maks. 5 MB)
- ✅ Edit gambar & metadata (judul, deskripsi, kategori, warna aksen)
- ✅ Hapus gambar dengan konfirmasi modal
- ✅ Filter galeri berdasarkan kategori
- ✅ Lightbox untuk preview gambar
- ✅ Halaman daftar anggota kelompok
- ✅ Desain Pinterest-style, responsif, modern

## Cara Setup

### 1. Persyaratan
- PHP >= 7.4
- MySQL / MariaDB
- Apache dengan mod_rewrite aktif (XAMPP/Laragon/LAMP)

### 2. Import Database
```sql
mysql -u root -p < db.sql
```
Atau import file `db.sql` via phpMyAdmin.

### 3. Konfigurasi Database
Edit `application/config/database.php`:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',        // sesuaikan
'database' => 'galeri_4ia07',
```

### 4. Konfigurasi URL
Jika tidak berjalan di root, edit `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/ci3_galeri/';
```

### 5. Permission Upload
Pastikan folder `upload/images/` dapat ditulis (writable):
```bash
chmod 755 upload/images/
```

### 6. Jalankan
Akses via browser: `http://localhost/ci3_galeri/`

## Struktur Folder
```
ci3_galeri/
├── application/
│   ├── config/          # Konfigurasi CI3
│   ├── controllers/
│   │   ├── Galeri.php   # Controller CRUD gambar
│   │   └── Anggota.php  # Controller halaman anggota
│   ├── models/
│   │   ├── M_Galeri.php
│   │   └── M_Anggota.php
│   └── views/
│       ├── layouts/     # Header & Footer
│       ├── galeri/      # Halaman galeri
│       └── anggota/     # Halaman anggota
├── assets/
│   ├── css/style.css
│   └── js/app.js
├── system/              # Core CodeIgniter 3
├── upload/images/       # Folder upload gambar
├── db.sql               # Database dump
└── README.md
```

## Anggota Kelompok
Lihat halaman `/anggota` di aplikasi, atau tabel `anggota` di database.
