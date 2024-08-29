<?php
session_start();
include '../config/koneksi.php'; // Pastikan file ini berisi koneksi ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Anda harus login untuk mengedit reservasi.";
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

// Ambil data reservasi dari database
$sql = "SELECT * FROM reservasi WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$reservasi_id, $_SESSION['user_id']]);
$reservasi = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservasi) {
    echo "Reservasi tidak ditemukan.";
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pemesan = isset($_POST['nama_pemesan']) ? trim($_POST['nama_pemesan']) : '';
    $nomor_hp = isset($_POST['nomor_hp']) ? trim($_POST['nomor_hp']) : '';
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : '';
    $jumlah_orang = isset($_POST['jumlah_orang']) ? intval($_POST['jumlah_orang']) : 0;
    $harga_paket = isset($_POST['harga_paket']) ? floatval($_POST['harga_paket']) : 0;
    $pelayanan = isset($_POST['pelayanan']) ? $_POST['pelayanan'] : [];

    $biaya_penginapan = in_array('100000', $pelayanan) ? 100000 : 0;
    $biaya_transportasi = in_array('200000', $pelayanan) ? 200000 : 0;
    $biaya_servis = in_array('500000', $pelayanan) ? 500000 : 0;

    $total_pelayanan = $biaya_penginapan + $biaya_transportasi + $biaya_servis;
    $jumlah_tagihan = ($harga_paket + $total_pelayanan) * $jumlah_orang;

    $update_sql = "UPDATE reservasi SET nama_pemesan = ?, nomor_hp = ?, tanggal = ?, jumlah_orang = ?, harga_paket = ?, jumlah_tagihan = ?, pelayanan_penginapan = ?, pelayanan_transportasi = ?, pelayanan_servis = ? WHERE id = ? AND user_id = ?";
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->execute([
        $nama_pemesan,
        $nomor_hp,
        $tanggal,
        $jumlah_orang,
        $harga_paket,
        $jumlah_tagihan,
        $biaya_penginapan,
        $biaya_transportasi,
        $biaya_servis,
        $reservasi_id,
        $_SESSION['user_id']
    ]);

    if ($update_stmt->rowCount() > 0) {
        header("Location: list_reservasi.php");
        exit;
    } else {
        echo "Terjadi kesalahan dalam memperbarui reservasi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservasi</title>
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
    <section class="form-section" id="reservasi-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Edit Reservasi</h5>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" value="<?= htmlspecialchars($reservasi['nama_pemesan']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?= htmlspecialchars($reservasi['nomor_hp']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pesan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= htmlspecialchars($reservasi['tanggal']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                                    <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" value="<?= htmlspecialchars($reservasi['jumlah_orang']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="harga_paket" class="form-label">Harga Paket</label>
                                    <input type="number" class="form-control" id="harga_paket" name="harga_paket" value="<?= htmlspecialchars($reservasi['harga_paket']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pelayanan Paket Perjalanan</label>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelayanan[]" id="penginapan" value="100000" <?= $reservasi['pelayanan_penginapan'] > 0 ? 'checked' : '' ?> onchange="updateTagihan()">
                                            <label class="form-check-label" for="penginapan">Penginapan (Rp 100,000)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelayanan[]" id="transportasi" value="200000" <?= $reservasi['pelayanan_transportasi'] > 0 ? 'checked' : '' ?> onchange="updateTagihan()">
                                            <label class="form-check-label" for="transportasi">Transportasi (Rp 200,000)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pelayanan[]" id="servis" value="500000" <?= $reservasi['pelayanan_servis'] > 0 ? 'checked' : '' ?> onchange="updateTagihan()">
                                            <label class="form-check-label" for="servis">Servis (Rp 500,000)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jumlah_tagihan" class="form-label">Jumlah Tagihan</label>
                                    <input type="number" class="form-control" id="jumlah_tagihan" name="jumlah_tagihan" value="<?= htmlspecialchars($reservasi['jumlah_tagihan']) ?>" readonly>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        function updateTagihan() {
            const hargaPaket = parseFloat(document.getElementById('harga_paket').value) || 0;
            const jumlahOrang = parseFloat(document.getElementById('jumlah_orang').value) || 0;

            const penginapan = document.getElementById('penginapan').checked ? 100000 : 0;
            const transportasi = document.getElementById('transportasi').checked ? 200000 : 0;
            const servis = document.getElementById('servis').checked ? 500000 : 0;

            const totalPelayanan = penginapan + transportasi + servis;
            const jumlahTagihan = (hargaPaket + totalPelayanan) * jumlahOrang;

            document.getElementById('jumlah_tagihan').value = jumlahTagihan;
        }
    </script>
</body>
</html>
