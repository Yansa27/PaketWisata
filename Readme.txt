
# Paket Wisata - PHP Native Application TA VSGA JWD SUMSEL 2024

## Deskripsi
Aplikasi ini adalah sistem manajemen paket wisata yang dibangun menggunakan PHP native. Fitur utama aplikasi ini meliputi:
- **Pengelolaan Reservasi Paket Wisata (CRUD)**: Pengguna dapat membuat, membaca, memperbarui, dan menghapus reservasi.
- **Reservasi Paket Wisata oleh Pengguna**: Pengguna dapat melakukan reservasi paket wisata.
- **Dashboard Pengguna**: Dashboard untuk manajemen pesanan reservasi.

## Persyaratan Sistem
- PHP versi 8.1 atau lebih tinggi
- Web server (Apache)
- Database MySQL

## Instalasi

### 1. Kloning atau Unduh Aplikasi
- **Kloning repository ini menggunakan Git:**
  ```bash
  git clone https://github.com/Yansa27/PaketWisata.git
  ```
- **Atau unduh ZIP dari repository dan ekstrak di direktori web server Anda.**

### 2. Konfigurasi Database
- **Buat database baru di MySQL untuk aplikasi ini.**
- **Import file `paketwisata.sql` yang ada di dalam folder `database` ke database yang telah dibuat.**
- **Buka file `config/koneksi.php` dan sesuaikan konfigurasi database:**
  ```php
  <?php
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'nama_database');
  define('DB_USER', 'username_mysql');
  define('DB_PASS', 'password_mysql');
  ?>
  ```

### 3. Jalankan Aplikasi
- Akses aplikasi melalui browser dengan URL yang sesuai, misalnya:
  ```
  http://localhost/paketwisata/
  ```

## Struktur Direktori dan File

- **/Auth/login.php**: Halaman login.
- **/Auth/login_proccess.php**: File untuk memproses login pengguna.
- **/Auth/register.php**: Halaman registrasi pengguna baru.
- **/Auth/register_process.php**: File untuk memproses registrasi pengguna.
- **/Auth/logout.php**: File untuk menangani proses logout.
- **/assetAdmin/**: Folder yang berisi aset Dashboard.
- **/uploads/**: Direktori untuk menyimpan gambar paket wisata yang diunggah.
- **/dashboard.php**: Dashboard pengguna setelah login.
- **/daftarpaket.php**: Halaman untuk mengelola daftar paket wisata.
- **/reservasi/list_reservasi.php**: Halaman untuk melihat daftar reservasi.
- **/reservasi/reservasi.php**: Halaman untuk melakukan reservasi paket wisata.
- **/reservasi/process_reservation.php**: File untuk memproses reservasi.
- **/reservasi/edit_reservasi.php**: Halaman untuk mengedit reservasi yang sudah dibuat.
- **/reservasi/delete_reservasi.php**: File untuk menghapus reservasi yang sudah dibuat.
- **/style.css**: File CSS utama untuk styling aplikasi.
- **/image/**: Direktori untuk menyimpan gambar tambahan yang digunakan dalam aplikasi.
- **Readme.txt**: File ini berisi informasi tentang aplikasi, instalasi, dan penggunaan.

## Kredit
- **Pengembang:** Juliansa ([juliansadev@gmail.com](mailto:juliansadev@gmail.com))
- **Framework:** PHP Native (tanpa framework PHP eksternal)
- **Ikon dan Desain:** Bootstrap Icons, FontAwesome, SweetAlert, SB Admin.

## Lisensi
Open Source By Me

