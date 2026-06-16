# SIM-PESERTA

**Sistem Informasi Manajemen Peserta Sertifikasi** — Aplikasi berbasis Laravel untuk mengelola data peserta uji kompetensi. Mendukung operasi CRUD, pencarian, dan filter berdasarkan skema sertifikasi.

---

## Prasyarat

- PHP 8.2 atau lebih baru
- [Composer](https://getcomposer.org/) versi terbaru
- Database SQLite (default) atau database lain yang didukung Laravel

---

## Instalasi & Menjalankan Aplikasi

### 1. Clone repositori dan instal dependensi

```bash
composer install
```

### 2. Konfigurasi environment

Berkas `.env` sudah tersedia dengan pengaturan default untuk SQLite. Jika ingin menyesuaikan konfigurasi database, salin dan edit berkas `.env.example`:

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Migrasi database dan isi data awal

Perintah berikut menjalankan migrasi tabel dan mengisi data contoh skema serta peserta:

```bash
php artisan migrate --seed
```

Jika ingin menjalankan migrasi dari awal (menghapus data yang sudah ada):

```bash
php artisan migrate:fresh --seed
```

### 4. Jalankan server pengembangan

```bash
php artisan serve
```

Buka browser dan akses `http://localhost:8000`. Halaman utama akan otomatis mengarah ke daftar peserta sertifikasi.

---

## Fitur Utama

| Fitur | Keterangan |
|-------|------------|
| **CRUD Peserta** | Tambah, lihat detail, ubah, dan hapus data peserta |
| **Pencarian** | Cari peserta berdasarkan nama lengkap atau nomor peserta |
| **Filter Skema** | Filter data peserta berdasarkan skema sertifikasi yang dipilih |
| **Flash Message** | Notifikasi sukses atau gagal setelah operasi Create/Update/Delete |
| **Konfirmasi Hapus** | Dialog konfirmasi JavaScript sebelum menghapus data |
| **Desain Responsif** | Tampilan menyesuaikan ukuran layar desktop, tablet, dan mobile |

---

## Struktur Direktori Penting

```
app/
├── Http/Controllers/PesertaController.php   # Controller utama
├── Models/
│   ├── Peserta.php                           # Model Peserta (belongsTo Skema)
│   └── Skema.php                             # Model Skema (hasMany Peserta)

database/
├── migrations/
│   ├── ..._create_skemas_table.php           # Tabel skema sertifikasi
│   └── ..._create_pesertas_table.php         # Tabel data peserta
└── seeders/
    ├── DatabaseSeeder.php                    # Pemanggil utama seeder
    ├── SkemaSeeder.php                       # Data awal skema
    └── PesertaSeeder.php                     # Data awal peserta

resources/views/
├── layouts/app.blade.php                     # Layout utama
└── peserta/
    ├── index.blade.php                       # Daftar peserta
    ├── create.blade.php                      # Form tambah
    ├── show.blade.php                        # Detail peserta
    └── edit.blade.php                        # Form edit

public/
├── css/style.css                             # Stylesheet kustom
└── js/app.js                                 # JavaScript kustom
```

---

## Database

Aplikasi menggunakan SQLite secara default. Berkas database berada di `database/database.sqlite`.

### Tabel `skemas`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | integer | Primary key |
| `kode_skema` | string | Kode unik skema (contoh: `SKM-001`) |
| `nama_skema` | string | Nama skema sertifikasi |
| `jenis` | enum | `wajib` atau `pilihan` |
| `timestamps` | datetime | Waktu dibuat/diperbarui |

### Tabel `pesertas`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | integer | Primary key |
| `nomor_peserta` | string | Nomor unik peserta (contoh: `PSR-2026-001`) |
| `nama_lengkap` | string | Nama lengkap peserta |
| `skema_id` | foreign key | Relasi ke tabel `skemas` |
| `status` | enum | `Terdaftar`, `Proses`, `Kompeten`, `Belum Kompeten` |
| `tanggal_uji` | date | Tanggal pelaksanaan uji kompetensi |
| `timestamps` | datetime | Waktu dibuat/diperbarui |

---

## Teknologi

- **Framework**: Laravel 12
- **Bahasa**: PHP 8.2+
- **Database**: SQLite
- **Frontend**: Blade, CSS kustom, JavaScript vanilla
- **Font**: Outfit (heading) + Inter (body)
