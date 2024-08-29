<?php
session_start();
include '../config/koneksi.php'; // Pastikan file ini berisi koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mendapatkan user berdasarkan email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query); // Gunakan $pdo dari koneksi.php
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan informasi user ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Redirect ke halaman dashboard atau home
            header("Location: ../dashboard.php");
            exit();
        } else {
            // Password salah
            $_SESSION['error'] = "Password salah.";
        }
    } else {
        // Email tidak ditemukan
        $_SESSION['error'] = "Email tidak ditemukan.";
    }

    // Redirect kembali ke halaman login jika gagal
    header("Location: login.php");
    exit();
}
?>
