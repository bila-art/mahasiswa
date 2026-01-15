<?php
session_start();
require 'koneksi.php';

// Jika sudah login, tidak perlu register lagi
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1. Cek apakah email sudah terdaftar
    $check_email = mysqli_query($koneksi, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error_msg = "Email sudah terdaftar! Gunakan email lain.";
    }
    // 2. Cek kesesuaian password
    elseif ($password !== $confirm_password) {
        $error_msg = "Konfirmasi password tidak sesuai!";
    }
    // 3. Tambahan: Cek panjang password (opsional tapi disarankan)
    elseif (strlen($password) < 6) {
        $error_msg = "Password minimal harus 6 karakter!";
    } else {
        // 4. Hash Password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 5. Simpan ke Database
        $query = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$hashed_password')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Registrasi berhasil! Silakan login.');
                    window.location='login.php';
                  </script>";
            exit;
        } else {
            $error_msg = "Terjadi kesalahan saat mendaftar: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .register-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .card {
            border-radius: 15px;
        }

        .btn-dark {
            background-color: #212529;
            border: none;
        }

        .btn-dark:hover {
            background-color: #343a40;
        }
    </style>
</head>

<body>

    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4 p-lg-5">
                        <div class="text-center mb-4">
                            <i class="bi bi-person-plus-fill display-4 text-dark"></i>
                            <h3 class="fw-bold mt-2">Daftar Akun Baru</h3>
                            <p class="text-muted small">Lengkapi data di bawah untuk bergabung</p>
                        </div>

                        <?php if (isset($error_msg)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $error_msg; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" value="<?= isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '' ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Ulangi password" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" name="register" class="btn btn-dark btn-lg shadow-sm">Daftar Sekarang</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0 text-muted">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold">Login di sini</a></p>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-4 text-muted small">&copy; 2026 Web Akademik</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>