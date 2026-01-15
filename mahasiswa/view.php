<?php
session_start();
// 1. Proteksi: Pastikan user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

require('../koneksi.php');

// 2. Keamanan: Ambil dan bersihkan parameter NIM
if (!isset($_GET['nim'])) {
    header("Location: index.php");
    exit;
}
$nim = mysqli_real_escape_string($koneksi, $_GET['nim']);

// 3. Query Data (JOIN tetap digunakan untuk nama prodi)
$sql = "SELECT mahasiswa.*, prodi.nama_prodi
        FROM mahasiswa
        JOIN prodi ON mahasiswa.prodi_id = prodi.id
        WHERE mahasiswa.nim = '$nim'";
$result = $koneksi->query($sql);
$data = $result->fetch_assoc();

// Cek jika data ada
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$base = '..'; // Path untuk navbar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa - <?= htmlspecialchars($data['nama_mhs']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include '../partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white py-3">
                        <h4 class="mb-0 text-center">Detail Data Mahasiswa</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small uppercase">NIM</label>
                            <p class="fs-5 border-bottom pb-2"><?= $data['nim']; ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small uppercase">Nama Lengkap</label>
                            <p class="fs-5 border-bottom pb-2"><?= htmlspecialchars($data['nama_mhs']); ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small uppercase">Tanggal Lahir</label>
                            <p class="fs-5 border-bottom pb-2"><?= date('d F Y', strtotime($data['tgl_lahir'])); ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small uppercase">Alamat</label>
                            <p class="fs-5 border-bottom pb-2"><?= nl2br(htmlspecialchars($data['alamat'])); ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small uppercase">Program Studi</label>
                            <p class="fs-5 border-bottom pb-2">
                                <span class="badge bg-info text-dark"><?= htmlspecialchars($data['nama_prodi']); ?></span>
                            </p>
                        </div>

                        <div class="d-grid mt-4">
                            <a href="index.php" class="btn btn-secondary shadow-sm">Kembali ke Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>