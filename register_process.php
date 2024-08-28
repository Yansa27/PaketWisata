<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi data
    if ($password !== $confirm_password) {
        $_SESSION['errors'] = 'Password tidak cocok.';
        header('Location: register.php');
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'paketwisata');

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Persiapkan query untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Registrasi berhasil! Silakan login.';
        header('Location: register.php');
    } else {
        $_SESSION['errors'] = 'Terjadi kesalahan: ' . $stmt->error;
        header('Location: register.php');
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['errors'] = 'Invalid request.';
    header('Location: register.php');
}
?>
