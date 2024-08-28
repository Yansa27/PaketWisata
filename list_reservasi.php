<?php
session_start(); 

include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Reservasi - Paket Wisata</title>
    <link href="assetAdmin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assetAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
                 
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <div class="sidebar-brand-icon">
                    </div>
                    <div class="sidebar-brand-text mx-3">PAKET WISATA</div>
                </a>

                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Home -->
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] === '/paketwisata/') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/paketwisata/">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Home</span>
                    </a>
                </li>

                <!-- Nav Item - Dashboard -->
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] === '/paketwisata/dashboard.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="http://localhost/paketwisata/dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Nav Item - List Reservasi -->
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] === '/paketwisata/list_reservasi.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="/paketwisata/list_reservasi.php">
                        <i class="fas fa-fw fa-list"></i>
                        <span>List Reservasi</span>
                    </a>
                </li>

                <!-- Nav Item - Daftar Paket -->
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] === '/paketwisata/daftarpaket.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="/paketwisata/daftarpaket.php">
                        <i class="fas fa-fw fa-suitcase"></i>
                        <span>Daftar Paket</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Nav Item - Logout -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
                </ul>           
                <!-- End of Sidebar -->


        <!-- Sidebar content remains unchanged -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Content -->
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <!-- Topbar content remains unchanged -->

                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Daftar Reservasi</h1>

                    <!-- Content Row -->
                    <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive"> <!-- Tambahkan class ini -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pemesan</th>
                                        <th>Nomor HP</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Orang</th>
                                        <th>Harga Paket</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Paket Wisata</th>
                                        <th>Pelayanan Penginapan</th>
                                        <th>Pelayanan Transportasi</th>
                                        <th>Pelayanan Servis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Koneksi ke database
                                    $conn = new mysqli('localhost', 'root', '', 'paketwisata');

                                    // Cek koneksi
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Pastikan pengguna sudah login
                                    if (!isset($_SESSION['user_id'])) {
                                        echo "<tr><td colspan='13'>Anda harus login untuk melihat daftar reservasi.</td></tr>";
                                        $conn->close();
                                        exit;
                                    }

                                    // Query untuk mengambil data reservasi
                                    $sql = "SELECT r.id, r.nama_pemesan, r.nomor_hp, r.tanggal, r.jumlah_orang, r.harga_paket, r.jumlah_tagihan, r.status, p.nama_paket,
                                                r.pelayanan_penginapan, r.pelayanan_transportasi, r.pelayanan_servis
                                            FROM reservasi r
                                            JOIN paket_wisata p ON r.paket_wisata_id = p.id
                                            WHERE r.user_id = ?
                                            ORDER BY r.created_at DESC";
                                    $stmt = $conn->prepare($sql);
                                    if ($stmt === false) {
                                        die("Prepare failed: " . $conn->error);
                                    }
                                    $stmt->bind_param("i", $_SESSION['user_id']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result === false) {
                                        die("Execute failed: " . $stmt->error);
                                    }

                                    if ($result->num_rows > 0):
                                        $no = 1; // Mulai dari nomor 1
                                        while ($row = $result->fetch_assoc()):
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td> 
                                            <td><?= htmlspecialchars($row['nama_pemesan']) ?></td>
                                            <td><?= htmlspecialchars($row['nomor_hp']) ?></td>
                                            <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                            <td><?= htmlspecialchars($row['jumlah_orang']) ?></td>
                                            <td>Rp <?= number_format($row['harga_paket'], 0, ',', '.') ?></td>
                                            <td>Rp <?= number_format($row['jumlah_tagihan'], 0, ',', '.') ?></td>
                                            
                                            <td><?= htmlspecialchars($row['nama_paket']) ?></td>
                                            <td><?= htmlspecialchars($row['pelayanan_penginapan']) ?></td>
                                            <td><?= htmlspecialchars($row['pelayanan_transportasi']) ?></td>
                                            <td><?= htmlspecialchars($row['pelayanan_servis']) ?></td>
                                            <td>
                                                <a href="edit_reservasi.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="#" class="btn btn-danger btn-sm delete-btn" data-id="<?= htmlspecialchars($row['id']) ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                        endwhile;
                                    else:
                                    ?>
                                        <tr>
                                            <td colspan="13">Belum ada reservasi.</td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php
                                    // Menutup statement dan koneksi
                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                </div>
            </div>
            <!-- End of Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assetAdmin/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            // Konfirmasi SweetAlert untuk aksi delete
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Mencegah aksi default link

                var id = $(this).data('id'); // Ambil ID dari data-id
                var url = 'delete_reservasi.php?id=' + id; // URL untuk request delete

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak dapat membatalkan tindakan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika user mengonfirmasi, arahkan ke URL delete
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
</body>

</html>
