<?php
session_start();

// 1. Proteksi Halaman: Hanya user login yang bisa masuk
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

require('../koneksi.php');

// 2. Validasi Parameter ID dan Keamanan Query
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$sql = "SELECT * FROM prodi WHERE id = '$id'";
$result = $koneksi->query($sql);
$edit = $result->fetch_assoc();

if (!$edit) {
    echo "<script>alert('Data Prodi tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// 3. Set base path untuk navbar
$base = '..';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prodi - <?= htmlspecialchars($edit['nama_prodi']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <?php include '../partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning py-3">
                        <h4 class="mb-0 text-dark"><i class="bi bi-pencil-square me-2"></i>Edit Program Studi</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="gbproses.php">
                            <input type="hidden" name="id" value="<?= $edit['id']; ?>">

                            <div class="mb-3">
                                <label for="nama_prodi" class="form-label fw-bold">Nama Prodi</label>
                                <input type="text" name="nama_prodi" value="<?= htmlspecialchars($edit['nama_prodi']); ?>" class="form-control" id="nama_prodi" required>
                            </div>

                            <div class="mb-3">
                                <label for="jenjang" class="form-label fw-bold">Jenjang Pendidikan</label>
                                <select name="jenjang" id="jenjang" class="form-select" required>
                                    <option value="">-- Pilih Jenjang --</option>
                                    <option value="D2" <?= ($edit['jenjang'] == 'D2') ? 'selected' : '' ?>>Diploma 2 (D2)</option>
                                    <option value="D3" <?= ($edit['jenjang'] == 'D3') ? 'selected' : '' ?>>Diploma 3 (D3)</option>
                                    <option value="D4" <?= ($edit['jenjang'] == 'D4') ? 'selected' : '' ?>>Diploma 4 (D4)</option>
                                    <option value="S1" <?= ($edit['jenjang'] == 'S1') ? 'selected' : '' ?>>Sarjana (S1)</option>
                                    <option value="S2" <?= ($edit['jenjang'] == 'S2') ? 'selected' : '' ?>>Magister (S2)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3"><?= htmlspecialchars($edit['keterangan']); ?></textarea>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" name="update" class="btn btn-warning px-4 fw-bold">Update Prodi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>