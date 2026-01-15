<?php
session_start();

// 1. Proteksi Halaman: Jika belum login, tendang ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';

// 2. Set base path untuk navbar (karena ini di root, base adalah titik '.')
$base = '.';

// (Opsional) Ambil statistik sederhana untuk ditampilkan
$jml_mhs = mysqli_num_rows(mysqli_query($koneksi, "SELECT nim FROM mahasiswa"));
$jml_prodi = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM prodi"));
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Akademik System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .welcome-section {
            padding: 80px 0;
            background: #fff;
            border-radius: 15px;
        }

        .stat-card {
            transition: transform 0.3s;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-light">

    <?php include 'partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="welcome-section text-center shadow-sm mb-5">
            <h1 class="display-4 fw-bold text-dark">Welcome, <?= htmlspecialchars($_SESSION['nama']); ?>!</h1>
            <p class="lead text-muted">Selamat datang di Sistem Informasi Akademik Terpadu.</p>
            <hr class="my-4 mx-auto" style="width: 100px; height: 3px; background: #212529;">
        </div>

        <div class="row justify-content-center g-4 text-center">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-primary text-white h-100">
                    <div class="card-body">
                        <i class="bi bi-people-fill display-3"></i>
                        <h3 class="mt-3"><?= $jml_mhs; ?></h3>
                        <p class="mb-0">Total Mahasiswa</p>
                        <a href="mahasiswa/index.php" class="btn btn-light btn-sm mt-3 px-4">Kelola Data</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm bg-success text-white h-100">
                    <div class="card-body">
                        <i class="bi bi-building-fill display-3"></i>
                        <h3 class="mt-3"><?= $jml_prodi; ?></h3>
                        <p class="mb-0">Total Program Studi</p>
                        <a href="prodi/index.php" class="btn btn-light btn-sm mt-3 px-4">Kelola Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>