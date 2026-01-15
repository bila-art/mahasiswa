<?php
session_start();

// 1. Proteksi: Hanya user login yang bisa melihat detail prodi
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

require('../koneksi.php');

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$sql = "SELECT * FROM prodi where id=$_GET[id]";
$result = $koneksi->query($sql);
$data = $result->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data Prodi tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
$base = '..'; // Path untuk navbar
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Prodi - <?= htmlspecialchars($data['nama_prodi']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <?php include '../partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white py-3">
                        <h4 class="mb-0 text-center"><i class="bi bi-info-circle me-2"></i>Detail Program Studi</h4>
                    </div>
                    <div class="card-body p-4">

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Nama Program Studi</label>
                            <p class="fs-5 border-bottom pb-2"><?= htmlspecialchars($data['nama_prodi']); ?></p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Jenjang Pendidikan</label>
                            <p class="fs-5 border-bottom pb-2">
                                <span class="badge bg-primary"><?= $data['jenjang']; ?></span>
                            </p>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small text-uppercase">Keterangan / Deskripsi</label>
                            <p class="fs-6 bg-light p-3 rounded border">
                                <?= !empty($data['keterangan']) ? nl2br(htmlspecialchars($data['keterangan'])) : '<em class="text-muted">Tidak ada keterangan.</em>'; ?>
                            </p>
                        </div>

                        <div class="d-grid mt-4">
                            <a href="index.php" class="btn btn-secondary shadow-sm">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Prodi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>