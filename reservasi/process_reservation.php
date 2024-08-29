<?php
session_start();
include '../config/koneksi.php'; // Pastikan file ini berisi koneksi ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Anda harus login untuk melakukan reservasi.";
    exit;
}

// Ambil data dari form
$paket_id = isset($_POST['paket_wisata_id']) ? intval($_POST['paket_wisata_id']) : 0;
$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$jumlah_orang = isset($_POST['jumlah_orang']) ? intval($_POST['jumlah_orang']) : 0;
$harga_paket = isset($_POST['harga_paket']) ? floatval($_POST['harga_paket']) : 0;
$nama_pemesan = isset($_POST['nama_pemesan']) ? trim($_POST['nama_pemesan']) : '';
$nomor_hp = isset($_POST['nomor_hp']) ? trim($_POST['nomor_hp']) : '';
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';

// Koneksi ke database menggunakan PDO
$host = 'localhost';
$db = 'paketwisata';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// Ambil biaya pelayanan dari form (bisa disesuaikan dengan data atau asumsi default)
$biaya_penginapan = isset($_POST['pelayanan']) && in_array('100000', $_POST['pelayanan']) ? 100000 : 0;
$biaya_transportasi = isset($_POST['pelayanan']) && in_array('200000', $_POST['pelayanan']) ? 200000 : 0;
$biaya_servis = isset($_POST['pelayanan']) && in_array('500000', $_POST['pelayanan']) ? 500000 : 0;

// Hitung total biaya pelayanan
$total_pelayanan = $biaya_penginapan + $biaya_transportasi + $biaya_servis;
$jumlah_tagihan = ($harga_paket + $total_pelayanan) * $jumlah_orang;

// Simpan data reservasi ke database
$sql = "INSERT INTO reservasi (user_id, paket_wisata_id, jumlah_orang, harga_paket, jumlah_tagihan, nama_pemesan, nomor_hp, tanggal, pelayanan_penginapan, pelayanan_transportasi, pelayanan_servis) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $user_id,
    $paket_id,
    $jumlah_orang,
    $harga_paket,
    $jumlah_tagihan,
    $nama_pemesan,
    $nomor_hp,
    $tanggal,
    $biaya_penginapan,
    $biaya_transportasi,
    $biaya_servis
]);

if ($stmt->rowCount() > 0) {
    // Redirect ke list_reservasi.php setelah berhasil
    header("Location: list_reservasi.php");
    exit;
} else {
    echo "Terjadi kesalahan dalam proses reservasi.";
}
?>
