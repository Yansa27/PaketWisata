<?php
session_start();
include 'koneksi.php'; // Pastikan file ini berisi koneksi ke database

// Ambil ID paket dari parameter query
$paket_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit;
}

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'paketwisata');

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data paket wisata dari database
$sql = "SELECT * FROM paket_wisata WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $paket_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $paket = $result->fetch_assoc();
} else {
    echo "Paket tidak ditemukan.";
    exit;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Paket Wisata</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .form-section {
            padding: 40px 0;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 10px;
        }
        .form-control {
            border-radius: 5px;
            padding: 12px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #495057;
            box-shadow: none;
        }
        .form-check-label {
            margin-left: 10px;
            font-weight: 400;
        }
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }
        .mb-3 label {
            font-size: 14px;
            color: #495057;
        }
        .mb-3 input[type="text"],
        .mb-3 input[type="date"],
        .mb-3 input[type="number"] {
            font-size: 14px;
        }
        .mb-3 input[type="text"][disabled],
        .mb-3 input[type="number"][disabled] {
            background-color: #e9ecef;
            color: #495057;
        }
        .form-check {
            padding-bottom: 10px;
        }
        #jumlah_tagihan {
            background-color: #e9ecef;
            color: #495057;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <!-- Reservasi Form Section -->
    <section class="form-section" id="reservasi-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Reservasi Paket Wisata</h5>
                            <form action="process_reservation.php" method="post">
                                <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user_id']) ?>">
                                <input type="hidden" name="paket_wisata_id" value="<?= htmlspecialchars($paket['id']) ?>">
                                <input type="hidden" name="harga_paket" id="harga_paket" value="<?= htmlspecialchars($paket['harga']) ?>">

                                <div class="mb-3">
                                    <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pesan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pelayanan Paket Perjalanan</label>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelayanan[]" id="penginapan" value="100000" onchange="updateTagihan()">
                                            <label class="form-check-label" for="penginapan">
                                                Penginapan (Rp 100.000)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelayanan[]" id="transportasi" value="200000" onchange="updateTagihan()">
                                            <label class="form-check-label" for="transportasi">
                                                Transportasi (Rp 200.000)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelayanan[]" id="servis" value="500000" onchange="updateTagihan()">
                                            <label class="form-check-label" for="servis">
                                                Servis/Makanan (Rp 500.000)
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_orang" class="form-label">Jumlah Peserta</label>
                                    <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required min="1" oninput="updateTagihan()">
                                </div>

                                <div class="mb-3">
                                    <label for="harga_display" class="form-label">Harga Paket</label>
                                    <input type="text" class="form-control" id="harga_display" value="Rp <?= number_format($paket['harga'], 0, ',', '.') ?>" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_tagihan" class="form-label">Jumlah Tagihan</label>
                                    <input type="text" class="form-control" id="jumlah_tagihan" name="jumlah_tagihan" disabled>
                                </div>

                                <button type="submit" class="btn btn-primary">Reservasi Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        function updateTagihan() {
            const hargaPaket = parseFloat(document.getElementById('harga_paket').value);
            const jumlahOrang = parseInt(document.getElementById('jumlah_orang').value) || 0;
            const pelayananCheckboxes = document.querySelectorAll('input[name="pelayanan[]"]:checked');
            let totalPelayanan = 0;

            pelayananCheckboxes.forEach((checkbox) => {
                totalPelayanan += parseFloat(checkbox.value);
            });

            const jumlahTagihan = (hargaPaket + totalPelayanan) * jumlahOrang;
            document.getElementById('jumlah_tagihan').value = `Rp ${jumlahTagihan.toLocaleString()}`;
        }
    </script>
</body>
</html>
