# Produk Management System - Fastprint Test

Aplikasi berbasis web untuk manajemen produk terintegrasi data dari API Fastprint. Dibangun dengan standar **MVC** menggunakan **CodeIgniter 3** dan **AdminLTE 3**.

## 🚀 Fitur Utama
- **Automatic API Sync** Sinkronisasi data otomatis dari server Fastprint ke database lokal.
- **Dynamic Authentication:** Menangani generate username dan password API yang berubah setiap jam (Format: `tesprogrammer + d + m + y + C + Hour`) secara otomatis berdasarkan waktu server (Jakarta Time).
- **CRUD Produk:** Manajemen data produk (Create, Read, Update, Delete) yang responsif.
- **Advanced Validation:** Validasi menggunakan server-side (Form Validation) dan client-side (Numeric filter & SweetAlert2).
- **Relational Database:** Menggunakan normalisasi tabel (Produk, Kategori, Status) serta implementasi Foreign Key untuk relasi tabel `kategori` dan `status`.
- **Server-Side Validation:** Validasi input Nama Produk (Required), Harga (Required | Numeric), Kategori (Required), Status (Required).
- **Modern UI/UX:** Menggunakan AdminLTE 3, SweetAlert2, dan Select2.
- **Filter Otomatis:** Menampilkan hanya produk dengan status "bisa dijual" sesuai instruksi tes pada nomor 5 (link : `https://recruitment.fastprint.co.id/tes/tes/programmer/`).

## 🛠️ Teknologi yang Digunakan
* **Backend:** PHP 7.4+ (CodeIgniter 3)
* **Frontend:** AdminLTE 3 (Bootstrap 4)
* **Database:** MySQL
* **Library:** cURL (API Connection), SweetAlert2 (Konfirmasi Hapus), DataTables, Select2 (Searchable Dropdown).

## 📦 Cara Instalasi
1.  **Clone Repository:**
    ```bash
    git clone https://github.com/username-kamu/test-junior-programmer-egen.git
    ```
2.  **Konfigurasi Database:**
    * Buat database baru di phpMyAdmin dengan nama `db_fastprint`.
    * Import file SQL yang tersedia di folder `database/db_fastprint.sql` kedalam phpMyAdmin.
    * Sesuaikan setting di `application/config/database.php`.
    * Cari 'database' => '`{isi nama database}`'
3.  **Konfigurasi Base URL:**
    * Buka `application/config/config.php`.
    * Ubah `$config['base_url'] = 'http://localhost/{nama_file_project}';`.
4.  **Jalankan:**
    * Buka browser dan akses URL File tersebut.

## 🧠 Logika Khusus (Problem Solving)
Salah satu tantangan dalam tes ini adalah variabel username dan password API yang berubah-ubah. Saya menerapkan fungsi dinamis di `Produk_model.php` untuk menghasilkan kredensial secara otomatis berdasarkan waktu server saat ini:
```php
// Terletak di file Model pada Produk_model.php
date_default_timezone_set('Asia/Jakarta');
$tgl = date('d');
$bln = date('m');
$thn = date('y');
$jam = date ('H');

return [
    'username' => "tesprogrammer" . $tgl . $bln . $thn . "C" . $jam,
    'password' => md5("bisacoding-$tgl-$bln-$thn")
];