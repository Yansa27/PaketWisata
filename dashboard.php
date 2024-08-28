<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Paket Wisata</title>
    <!-- Gunakan path relatif sesuai dengan struktur folder Anda -->
    <link href="assetAdmin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assetAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body id="page-top">

    <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon">
        <!-- Ganti dengan ikon surat atau logo Anda -->
    </div>
    <div class="sidebar-brand-text mx-3">PAKET WISATA</div>
</a>

<!-- Divider -->
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




        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Content -->
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="assetAdmin/img/undraw_profile.svg" alt="Profile">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/auth/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- (Optional: Add heading or breadcrumb here) -->

                    <!-- Content Row -->
                    <div class="row">
                        <div class="welcome-section">
                            <div class="row align-items-center">
                                <div class="col-md-12 text-center">
                                    <i class="bi bi-hand-thumbs-up-fill welcome-icon"></i>
                                    <h1 class="welcome-text">Selamat Datang di Dashboard</h1>
                                    <p class="welcome-subtext">Kami senang melihatmu kembali! Semoga harimu menyenangkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Content -->

            <!-- Footer -->
            <footer class="footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto">
                        <span>© 2024 Paket Wisata</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts -->
    <script src="assetAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="assetAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assetAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assetAdmin/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
