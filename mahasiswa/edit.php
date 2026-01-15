<?php
session_start();
// Proteksi: Pastikan hanya user yang sudah login yang bisa akses
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

require('../koneksi.php');

/* ===== VALIDASI PARAMETER ===== */
if (!isset($_GET['nim'])) {
    header("Location: index.php");
    exit;
}

$nim = mysqli_real_escape_string($koneksi, $_GET['nim']);

/* ===== QUERY DATA MAHASISWA ===== */
$sql_mhs = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
$q_mhs = mysqli_query($koneksi, $sql_mhs);
$edit = mysqli_fetch_assoc($q_mhs);

if (!$edit) {
    echo "<script>alert('Data mahasiswa tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

/* ===== QUERY DATA PRODI ===== */
$sql_prodi = "SELECT * FROM prodi";
$q_prodi = mysqli_query($koneksi, $sql_prodi);

// Set base path untuk navbar (naik satu tingkat ke root)
$base = '..';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa - <?= htmlspecialchars($edit['nama_mhs']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border-radius: 12px;
        }

        .form-label {
            font-weight: 600;
        }
    </style>
</head>

<body class="bg-light">

    <?php include '../partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning text-dark py-3">
                        <h4 class="mb-0">Form Edit Mahasiswa</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="gbproses.php">

                            <div class="mb-3">
                                <label class="form-label text-muted">Nomor Induk Mahasiswa (NIM)</label>
                                <input type="text" class="form-control bg-light" value="<?= $edit['nim']; ?>" readonly>
                                <input type="hidden" name="nim" value="<?= $edit['nim']; ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Mahasiswa</label>
                                <input type="text" name="nama_mhs"
                                    value="<?= htmlspecialchars($edit['nama_mhs']); ?>"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir"
                                    value="<?= $edit['tgl_lahir']; ?>"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control"
                                    rows="3" required><?= htmlspecialchars($edit['alamat']); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Program Studi</label>
                                <select class="form-select" name="prodi_id" required>
                                    <option value="">-- Pilih Prodi --</option>
                                    <?php while ($row = mysqli_fetch_assoc($q_prodi)) : ?>
                                        <option value="<?= $row['id']; ?>"
                                            <?= ($row['id'] == $edit['prodi_id']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($row['nama_prodi']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-outline-secondary px-4">Batal</a>
                                <button type="submit" name="update" class="btn btn-warning px-4 fw-bold">Update Data</button>
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