# UntitledStay

UntitledStay adalah aplikasi pemesanan hotel berbasis web yang dibuat dengan Laravel. Pengunjung dapat melihat kamar dan promo, mencari kamar berdasarkan tanggal, lalu melakukan pemesanan setelah mendaftar atau masuk. Admin dapat mengelola kamar, pemesanan, fasilitas, dan promo.

> Data kamar, fasilitas, promo, dan akun bawaan yang tersedia melalui seeder adalah data contoh. Pilihan metode pembayaran dicatat untuk konfirmasi manual oleh staf; aplikasi ini belum terhubung ke payment gateway.

## Fitur

- Halaman beranda, pencarian kamar, detail kamar, fasilitas, promo, dan lokasi hotel.
- Pemeriksaan ketersediaan kamar berdasarkan tanggal menginap.
- Registrasi, login, profil pelanggan, riwayat pemesanan, dan pembatalan pemesanan yang masih menunggu.
- Checkout dengan pilihan metode pembayaran dan kode promo.
- Dashboard admin untuk mengelola kamar, pemesanan, fasilitas, dan promo.
- Pemisahan hak akses pelanggan, admin, dan super admin.

## Teknologi

- PHP 8.2 atau lebih baru
- Laravel 12
- MySQL/MariaDB atau SQLite
- Composer
- Node.js dan npm (opsional, untuk membangun aset Vite)

## Instalasi lokal

### 1. Persiapan

Pastikan PHP dan Composer tersedia. Untuk database MySQL/MariaDB, aktifkan ekstensi PHP `pdo_mysql`; untuk SQLite, aktifkan `pdo_sqlite`.

Clone repository dan masuk ke folder proyek:

```bash
git clone https://github.com/MercuryinGit/unhotel.git
cd unhotel
```

Pasang dependency PHP:

```bash
composer install
```

### 2. Konfigurasi environment

Salin `.env.example` menjadi `.env`.

PowerShell:

```powershell
Copy-Item .env.example .env
```

macOS/Linux atau Git Bash:

```bash
cp .env.example .env
```

Buat application key:

```bash
php artisan key:generate
```

### 3. Siapkan database

Pilih **salah satu** konfigurasi berikut. Kredensial database diatur di file `.env`.

#### Pilihan A: SQLite

`.env.example` sudah menggunakan SQLite. Buat file database jika belum ada.

PowerShell:

```powershell
New-Item -ItemType File -Path database\database.sqlite -Force
```

macOS/Linux atau Git Bash:

```bash
touch database/database.sqlite
```

Biarkan `DB_CONNECTION=sqlite` di `.env` dan jangan isi `DB_DATABASE` dengan nama database MySQL.

#### Pilihan B: MySQL/MariaDB

Buat database kosong, misalnya `db_unhotel`, melalui phpMyAdmin atau MySQL:

```sql
CREATE DATABASE db_unhotel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Lalu sesuaikan pengaturan berikut di `.env` dengan konfigurasi lokal Anda:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_unhotel
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat tabel dan data contoh

Jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

Perintah ini membuat tabel aplikasi dan mengisi data kamar, fasilitas, promo, serta akun demo. Jalankan pada database kosong untuk instalasi baru.

### 5. Jalankan aplikasi

```bash
php artisan serve
```

Buka alamat yang ditampilkan Artisan, biasanya <http://127.0.0.1:8000>.

### 6. (Opsional) Bangun aset frontend

Halaman aplikasi memakai Bootstrap melalui CDN. Jika Anda mengubah aset Vite di `resources/css` atau `resources/js`, pasang dependency dan buat build:

```bash
npm install
npm run build
```

Saat mengembangkan aset, gunakan `npm run dev` di terminal terpisah.

## Akun demo

Akun berikut dibuat oleh `php artisan migrate --seed`:

| Peran | Email | Kata sandi |
|---|---|---|
| Super admin | `super_admin@example.com` | `super_admin123` |
| Admin | `admin@example.com` | `admin123` |
| Pelanggan | `user@example.com` | `user123` |

Ganti atau hapus akun dan kata sandi demo sebelum aplikasi dipublikasikan. Jangan gunakan data demo untuk lingkungan produksi.

## Pengaturan lokasi hotel

Isi alamat hotel di `.env`. URL peta bersifat opsional:

```dotenv
HOTEL_ADDRESS="Alamat hotel Anda"
HOTEL_MAP_URL="https://maps.google.com/?q=..."
```

## Pengujian

Jalankan test suite:

```bash
php artisan test
```

## Catatan

- Jika muncul pesan tabel belum tersedia, pastikan `.env` menunjuk ke database yang benar, kemudian jalankan `php artisan migrate`.
- Jangan menjalankan `php artisan migrate:fresh` pada database yang berisi data penting karena perintah tersebut menghapus seluruh tabel.
- Integrasi payment gateway belum tersedia; status pembayaran dikelola dan dikonfirmasi secara manual.
