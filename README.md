# Ujikom Faathir

Aplikasi perpustakaan berbasis CodeIgniter 4 dengan fitur manajemen buku, kategori, pengguna, dan transaksi peminjaman.

## Tujuan

### Tujuan Umum
Membangun sistem perpustakaan sederhana untuk latihan Uji Kompetensi dengan alur admin dan user yang jelas.

### Tujuan Khusus
- Menyediakan fitur manajemen buku, kategori, dan pengguna.
- Menyediakan fungsi peminjaman dan pengembalian buku.
- Menggunakan CodeIgniter 4 dan Shield untuk otentikasi.
- Menyediakan tampilan admin dan user yang terpisah.

## Instalasi dan Setup

### Prasyarat
- PHP 8.2 atau lebih tinggi
- Composer
- Ekstensi PHP: `intl`, `mbstring`, `json`, `mysqlnd`, `curl`
- Database MySQL/MariaDB atau database lain yang didukung CodeIgniter 4
- Web server yang diarahkan ke folder `public`

### Langkah Instalasi
1. Salin file lingkungan:
   ```bash
   cp env .env
   ```

2. Install dependensi:
   ```bash
   composer install
   ```

3. Konfigurasikan `.env`:
   - `app.baseURL` menjadi `http://localhost:8080`
   - `database.default.hostname`
   - `database.default.database`
   - `database.default.username`
   - `database.default.password`

4. Impor skema database:
   ```bash
   mysql -u username -p nama_database < ukk_faathir.sql
   ```
   Jika file SQL tidak tersedia, buat tabel manual sesuai bagian Struktur Database.

5. Siapkan izin folder:
   - `writable/`
   - `public/uploads/`

6. Jalankan server lokal:
   ```bash
   php spark serve
   ```

7. Akses aplikasi:
   ```
   http://localhost:8080
   ```

> Pastikan web server diarahkan langsung ke folder `public`.

### Konfigurasi Apache / XAMPP
Jika menggunakan XAMPP, arahkan `DocumentRoot` ke `c:/xampp/htdocs/ujikom_faathir/public` dan pastikan `AllowOverride All` aktif untuk `mod_rewrite`.

## Contoh Penggunaan

### Route Utama Aplikasi
- `/` dan `/dashboard` — dashboard admin
- `/kelola_buku` — kelola buku admin
- `/create_buku` — tambah buku admin
- `/kelola_kategori` — kelola kategori admin
- `/kelola_user` — kelola anggota admin
- `/kelola_trans` — daftar transaksi admin
- `/daftar_buku` — daftar buku user
- `/daftar_peminjaman` — riwayat peminjaman user
- `/store_peminjaman` — pinjam buku
- `/kembalikan_buku` — kembalikan buku

### Alur Admin
1. Login sebagai admin.
2. Kelola buku di `/kelola_buku`.
3. Tambah kategori di `/create_kategori`.
4. Ubah data user di `/kelola_user`.
5. Pantau transaksi di `/kelola_trans`.

### Alur User
1. Login sebagai user.
2. Lihat buku di `/daftar_buku`.
3. Klik `Pinjam Buku`.
4. Cek peminjaman di `/daftar_peminjaman`.
5. Kembalikan buku bila selesai.

## Struktur Database

Aplikasi menggunakan tabel data utama berikut.

### Tabel `buku`
- `id` (PK, auto increment)
- `ISBN`
- `kategori_id` (FK ke `kategori.id`)
- `id_penulis` (FK ke `penulis.id_penulis`)
- `id_penerbit` (FK ke `penerbit.id_penerbit`)
- `judul`
- `tahun_terbit`
- `stok`
- `cover`

### Tabel `kategori`
- `id` (PK, auto increment)
- `nama_kategori`

### Tabel `penulis`
- `id_penulis` (PK, auto increment)
- `nama_penulis`

### Tabel `penerbit`
- `id_penerbit` (PK, auto increment)
- `nama_penerbit`

### Tabel `transaksi`
- `id` (PK, auto increment)
- `user_id` (FK ke `users.id`)
- `buku_id` (FK ke `buku.id`)
- `tanggal_pinjam`
- `tanggal_kembali`
- `status`

### Tabel Otentikasi Shield
CodeIgniter Shield menggunakan tabel default:
- `users`
- `auth_identities`
- `auth_groups_users`
- `auth_logins`
- `auth_token_logins`
- `auth_remember_tokens`
- `auth_permissions_users`

> `app/Config/Auth.php` mengatur nama tabel Shield. Jika Anda mengubah nama tabel, sesuaikan konfigurasi di file tersebut.

## Langkah-langkah Pengoperasian

### Menambah Buku
1. Login sebagai admin.
2. Buka `/create_buku`.
3. Isi data buku, kategori, penulis, penerbit, dan cover.
4. Simpan.

### Mengelola Kategori
1. Buka `/kelola_kategori`.
2. Tambah kategori baru.
3. Edit atau hapus kategori jika diperlukan.

### Mengelola User
1. Buka `/kelola_user`.
2. Edit email atau grup user.
3. Hapus user jika perlu.

### Memantau Transaksi
1. Buka `/kelola_trans` untuk admin.
2. Pantau peminjaman dengan status `dipinjam`.
3. Gunakan `/daftar_peminjaman` untuk melihat peminjaman user.

## Struktur Direktori

### Struktur Utama
- `app/` — kode aplikasi utama
- `public/` — entry point `index.php` dan aset publik
- `writable/` — cache, log, session, dan upload runtime
- `tests/` — unit dan integrasi test
- `vendor/` — dependensi Composer
- `env` — template pengaturan environment
- `.env` — konfigurasi environment lokal
- `ukk_faathir.sql` — skema database (jika ada)

### Struktur `app/`
- `app/Controllers/` — proses request, routing, dan logika aplikasi
- `app/Models/` — akses dan manipulasi data database
- `app/Views/` — tampilan antarmuka untuk admin, user, auth, dan bagian umum
- `app/Config/` — konfigurasi sistem, database, routing, dan Shield
- `app/Database/` — migrasi dan seed data (jika tersedia)

### Detail Views
- `app/Views/admin/` — halaman admin seperti dashboard, buku, kategori, user, transaksi
- `app/Views/user/` — halaman user untuk daftar buku dan peminjaman
- `app/Views/auth/` — form `login` dan `register`
- `app/Views/part/` — komponen halaman, navigasi, dan layout
- `app/Views/welcome_message.php` — tampilan default CodeIgniter

## Controllers, Models, dan Views

### Controllers
- `app/Controllers/Dashboard.php` — Menampilkan halaman dashboard admin.
- `app/Controllers/Home.php` — Menampilkan view `dashboard` pada route default jika digunakan.
- `app/Controllers/Buku.php` — Menangani CRUD buku, kategori, pencarian, dan halaman daftar buku user. Endpoint admin: `kelola_buku`, `create_buku`, `store_buku`, `edit_buku`, `update_buku`, `delete`, `kelola_kategori`, `create_kategori`, `store_kategori`, `edit_kategori`, `update_kategori`, `delete_kategori`. Endpoint user: `daftar_buku`.
- `app/Controllers/User.php` — Menampilkan daftar user, edit user, dan hapus user. Menggunakan tabel Shield: `auth_identities` dan `auth_groups_users`.
- `app/Controllers/Peminjaman.php` — Menyimpan peminjaman, menampilkan daftar peminjaman user, dan mengatur pengembalian buku. Memanggil `auth()->user()` untuk mendapatkan user login.
- `app/Controllers/Transaksi.php` — Menampilkan daftar transaksi peminjaman untuk admin.

### Models
- `app/Models/Buku.php` — Berhubungan dengan tabel `buku`. Field yang diizinkan: `ISBN`, `kategori_id`, `id_penulis`, `id_penerbit`, `judul`, `tahun_terbit`, `stok`, `cover`. Fungsi `getBukuLengkap()` menggabungkan data buku dengan `kategori`, `penulis`, dan `penerbit`.
- `app/Models/Kategori.php` — Berhubungan dengan tabel `kategori`. Field yang diizinkan: `nama_kategori`.
- `app/Models/Penulis.php` — Berhubungan dengan tabel `penulis`. Field yang diizinkan: `nama_penulis`.
- `app/Models/Penerbit.php` — Berhubungan dengan tabel `penerbit`. Field yang diizinkan: `nama_penerbit`.
- `app/Models/Peminjaman.php` — Berhubungan dengan tabel `transaksi`. Field yang diizinkan: `user_id`, `buku_id`, `tanggal_pinjam`, `tanggal_kembali`, `status`. Menyediakan `getPeminjamanWithBuku()` untuk mengambil data transaksi beserta judul buku.
- `app/Models/Transaksi.php` — File model ada tetapi kosong; logika transaksi saat ini dilakukan langsung di `app/Controllers/Transaksi.php`.

### Views
#### Admin
- `app/Views/admin/dashboard.php` — dashboard admin.
- `app/Views/admin/buku/kelola_buku.php` — daftar buku dan filter.
- `app/Views/admin/buku/create_buku.php` — form tambah buku.
- `app/Views/admin/buku/edit_buku.php` — form edit buku.
- `app/Views/admin/buku/kelola_kategori.php` — daftar kategori.
- `app/Views/admin/buku/create_kategori.php` — form tambah kategori.
- `app/Views/admin/buku/edit_kategori.php` — form edit kategori.
- `app/Views/admin/kelola_anggota/kelola_user.php` — daftar user.
- `app/Views/admin/kelola_anggota/edit_user.php` — form edit data user.
- `app/Views/admin/kelola_anggota/tambah_user.php` — form tambah user jika digunakan.
- `app/Views/admin/transaksi/transaksi.php` — daftar transaksi peminjaman.

#### User
- `app/Views/user/daftar_buku.php` — tampilan buku untuk user.
- `app/Views/user/daftar_peminjaman.php` — riwayat peminjaman user.

#### Auth
- `app/Views/auth/login.php` — halaman login.
- `app/Views/auth/register.php` — halaman register.

#### Komponen Umum
- `app/Views/part/index.php` — komponen navigasi dan layout bersama.
- `app/Views/welcome_message.php` — tampilan default CodeIgniter.

## CodeIgniter Shield dan Otentikasi

CodeIgniter Shield adalah library otentikasi resmi untuk CodeIgniter 4. Proyek ini menggunakan Shield untuk login, register, manajemen identitas, dan group/role.

### Rute Shield
Di `app/Config/Routes.php`, aplikasi memanggil:
```php
service('auth')->routes($routes);
```
Sehingga route login/register Shield otomatis terdaftar.

### Tabel Shield
Shield menggunakan tabel default yang dikonfigurasi di `app/Config/Auth.php`.

### Implementasi Shield dalam Aplikasi
- `app/Controllers/Peminjaman.php` menggunakan `auth()->user()` untuk mendapatkan user saat menyimpan peminjaman.
- `app/Controllers/User.php` menghapus dan mengedit user dengan mengakses tabel `auth_identities` dan `auth_groups_users`.
- Halaman login dan register disediakan oleh `app/Views/auth/login.php` dan `app/Views/auth/register.php`.

## Pengujian

Jalankan unit test dengan PHPUnit:
```bash
vendor/bin/phpunit
```

## Lisensi

Proyek ini menggunakan lisensi MIT.


