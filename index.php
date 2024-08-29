<?php
include 'config/koneksi.php'; // menyertakan file konfigurasi
session_start(); // Pastikan session dimulai

// Cek apakah pengguna sudah login
$is_logged_in = isset($_SESSION['user_id']);
// Ambil data paket wisata dari database
try {
    $stmt = $pdo->query('SELECT * FROM paket_wisata');
    $paket_wisata = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Wisata Raja Ampat Papua</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
    .video-section h2 {
        font-size: 1.75rem;
    }
    .video-section p {
        font-size: 1rem;
        color: #555;
    }
    .video-section .btn-primary {
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
    }
    .video-wrapper iframe {
        border-radius: 8px;
    }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">Logo</a>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#paket-wisata">Destinasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak</a>
                </li>
            </ul>
        </div>
        <?php if ($is_logged_in): ?>
            <a href="http://localhost/paketwisata/dashboard.php" class="btn login-button">Dashboard</a>
        <?php else: ?>
            <a href="http://localhost/paketwisata/auth/login.php" class="btn login-button">Login</a>
        <?php endif; ?>
    </div>
</nav>

    <!-- Jumbotron -->
    <header class="jumbotron">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Raja Ampat Papua</h1>
            <p class="lead">Temukan Paket Wisata Terbaik dan Nikmati Keindahan Alam yang Mengagumkan.</p>
            <a href="#" class="btn btn-primary btn-lg">Lihat Paket</a>
        </div>
    </header>
    <!-- End Jumbotron -->

    <section class="video-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Penjelasan di kiri -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">
                        Temukan Paket Eksklusif Kami
                    </h2>
                    <p class="mb-4">
                        Nikmati petualangan tak tertandingi dengan paket perjalanan yang dirancang khusus untuk Anda. Tonton video ini untuk melihat cuplikan perjalanan tak terlupakan Anda berikutnya.
                    </p>
                    <a href="#contact" class="btn btn-primary">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
                <!-- Video di kanan -->
                <div class="col-lg-6">
                    <div class="video-wrapper position-relative">
                        <iframe class="w-100" height="315" src="https://www.youtube.com/embed/UJiVARkYs0c" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Wisata Section -->
    <section class="package-section" id="paket-wisata">
    <div class="container text-center mb-5">
        <h2>Paket Wisata Terbaik</h2>
        <div class="row">
            <?php foreach ($paket_wisata as $paket): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= 'uploads/paket_wisata/' . $paket['foto'] ?>" class="card-img-top" alt="<?= htmlspecialchars($paket['nama_paket']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($paket['nama_paket']) ?></h5>
                        <div class="card-meta">
                            <div class="duration">
                                <i class="bi bi-clock"></i> <?= htmlspecialchars($paket['durasi']) ?> Hari
                            </div>
                            <div class="price">Rp <?= number_format($paket['harga'], 0, ',', '.') ?></div>
                        </div>
                        <p class="card-text"><?= htmlspecialchars($paket['deskripsi']) ?></p>
                        <div class="rating">
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                            <span class="star">&#9733;</span>
                        </div>
                        <a href="reservasi/reservasi.php?id=<?= $paket['id'] ?>" class="btn btn-primary">Reservasi</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


    <!-- Testimonial Section -->
    <section class="testimonial-section">
        <div class="container">
            <h2>Apa Kata Klien Kami</h2>
            <div class="row">
                <!-- Testimonial 1 -->
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <img src="image/client1.jpg" alt="Klien 1">
                        <div class="rating">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                        </div>
                        <h5>Andi Pratama</h5>
                        <p>"Perjalanan kami ke Raja Ampat sungguh luar biasa. Semua pengaturannya sempurna, dan pemandangannya sangat menakjubkan. Sangat direkomendasikan!"</p>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <img src="image/client2.jpg" alt="Klien 2">
                        <div class="rating">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                        </div>
                        <h5>Siti Nurhaliza</h5>
                        <p>"Saya memiliki pengalaman luar biasa dengan agen perjalanan ini. Perhatian terhadap detail dan layanan yang dipersonalisasi membuat liburan saya tak terlupakan."</p>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <img src="image/client3.jpg" alt="Klien 3">
                        <div class="rating">
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                            <span>&#9733;</span>
                        </div>
                        <h5>Joko Santoso</h5>
                        <p>"Perjalanan yang sangat baik dan memuaskan. Fasilitas yang disediakan sangat berkualitas dan bermanfaat. Terima kasih untuk semua pengalaman yang mengesankan."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-3">
        <div class="container text-center">
            <p>&copy; 2024 Raja Ampat Papua. Semua hak dilindungi.</p>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-9x2x63TYJvI65s5rqx2RJ3AD94ZnPa/VL4ORVgaHRG2D9zqz8fS/f63KM+4i5xS" crossorigin="anonymous"></script>
</body>
</html>
