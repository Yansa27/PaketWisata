<?php
session_start();
include '../config/koneksi.php'; // Pastikan file ini berisi koneksi ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Anda harus login untuk menghapus reservasi.";
    exit;
}

$reservasi_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

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

// Hapus data reservasi dari database
$sql = "DELETE FROM reservasi WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$reservasi_id, $_SESSION['user_id']]);

if ($stmt->rowCount() > 0) {
    header("Location: list_reservasi.php");
    exit;
} else {
    echo "Terjadi kesalahan dalam menghapus reservasi.";
}
?>
