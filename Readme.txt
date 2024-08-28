# Paket Wisata - PHP Native Application TA VSGA JWD SUMSEL 2024

## Deskripsi
Aplikasi ini merupakan sistem manajemen paket wisata yang dibangun menggunakan PHP native. Fitur utama aplikasi ini mencakup:
- Pengelolaan Reservasi paket wisata (CRUD).
- Reservasi paket wisata oleh pengguna.
- Dashboard pengguna untuk manajemen pesanan reservasi.

## Persyaratan Sistem
- PHP versi 8.1 atau lebih tinggi
- Web server (Apache)
- Database MySQL

## Instalasi
Berikut adalah langkah-langkah untuk menginstal dan menjalankan aplikasi ini di server lokal:

1. **Kloning atau Unduh Aplikasi:**
   - Kloning repository ini menggunakan Git:
     ```
     git clone https://github.com/username/repo-name.git
     ```
   - Atau unduh ZIP dari repository dan ekstrak di direktori web server Anda.

2. **Konfigurasi Database:**
   - Buat database baru di MySQL untuk aplikasi ini.
   - Import file `database.sql` yang ada di dalam folder `sql` ke database yang telah dibuat.
   - Buka file `koneksi.php` di direktori root proyek dan sesuaikan konfigurasi database dengan informasi yang benar:
     ```php
     <?php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'nama_database');
     define('DB_USER', 'username_mysql');
     define('DB_PASS', 'password_mysql');
     ?>
     ```

3. **Jalankan Aplikasi:**
   - Akses aplikasi melalui browser dengan URL yang sesuai, misalnya:
     ```
     http://localhost/paketwisata/
     ```

## Struktur Direktori dan File
- **/assetAdmin/**: Folder yang berisi aset Dashboard.
- **/uploads/**: Direktori untuk menyimpan gambar paket wisata yang diunggah.
- **koneksi.php**: File konfigurasi utama untuk koneksi database.
- **index.php**: Halaman utama aplikasi.
- **login.php**: Halaman login untuk pengguna aplikasi.
- **login_proccess.php**: File untuk memproses login pengguna.
- **register.php**: Halaman untuk registrasi pengguna baru.
- **register_process.php**: File untuk memproses registrasi pengguna.
- **dashboard.php**: Dashboard pengguna setelah login untuk manajemen pesanan reservasi.
- **daftarpaket.php**: Halaman untuk mengelola daftar paket wisata.
- **list_reservasi.php**: Halaman untuk melihat daftar reservasi.
- **reservasi.php**: Halaman untuk melakukan reservasi paket wisata.
- **process_reservation.php**: File untuk memproses reservasi yang dilakukan oleh pengguna.
- **edit_reservasi.php**: Halaman untuk mengedit reservasi yang sudah dibuat.
- **delete_reservasi.php**: File untuk menghapus reservasi yang sudah dibuat.
- **logout.php**: File untuk menangani proses logout.
- **style.css**: File CSS utama untuk styling aplikasi.
- **image/**: Direktori untuk menyimpan gambar tambahan yang digunakan dalam aplikasi.
- **Readme.txt**: File ini berisi informasi tentang aplikasi, instalasi, dan penggunaan.

## Kredit
- **Pengembang:**JULIANSA (juliansadev@gmail.com)
- **Framework:** PHP Native (tanpa framework PHP eksternal)
- **Ikon dan Desain:** Bootstrap Icons, FontAwesome, sweetalert, bsbadmin.

## Lisensi
Open Source By Me