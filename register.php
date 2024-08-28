<?php
// Mulai sesi
session_start();

// Tangani flash message jika ada
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;

// Hapus pesan flash setelah ditampilkan
unset($_SESSION['errors']);
unset($_SESSION['success']);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Registrasi</title>
    <style>
        body {
            margin: 0;
            overflow: hidden; /* Prevent scroll */
            height: 100vh;
            background-color: #f8f9fa; /* Light background color for fallback */
        }
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('image/jumbotron.jpg') no-repeat center center;
            background-size: cover;
            z-index: -1; /* Place the image behind the card */
        }
        .register-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .register-container .logo {
            display: block;
            margin: 0 auto 20px;
            width: 120px; /* Adjust width as needed */
            height: 120px; /* Adjust height as needed */
            background: url('image/package1.jpg') no-repeat center center;
            background-size: cover;
            border-radius: 50%;
        }
        .register-container h1 {
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 500;
            text-align: center;
        }
        .register-container .form-group label {
            font-size: 0.9rem;
        }
        .register-container .btn {
            padding: 10px;
            font-size: 1rem;
        }
        .btn-purple {
            background-color: #87CEEB; /* Light blue color */
            color: white;
        }
        .btn-purple:hover {
            background-color: #5a32a3; /* Darker blue color */
            color: white;
        }
        .login-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="background-image"></div>

    <div class="register-container">
        <div class="text-center mb-4">
            <div class="logo"></div>
            <h1>Paket Wisata Raja Ampat</h1>
        </div>

        <!-- Flash message section -->
        <?php if ($errors): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($errors) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form action="register_process.php" method="post">
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group mb-3">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn w-100 btn-purple">Daftar</button>
        </form>

        <!-- Login link -->
        <div class="login-link">
            <a href="login.php">Sudah punya akun? Login di sini</a>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
