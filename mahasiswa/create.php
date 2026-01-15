<?php
session_start();
// Proteksi halaman: Jika belum login, arahkan ke login.php di root
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

require('../koneksi.php');

// Ambil data prodi untuk dropdown
$query = "SELECT id, nama_prodi FROM prodi";
$result = mysqli_query($koneksi, $query);

// Set base path untuk navbar (karena file ini di dalam folder mahasiswa)
$base = '..';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include '../partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Data Mahasiswa</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="gbproses.php">

                            <div class="mb-3">
                                <label class="form-label fw-bold">NIM</label>
                                <input type="text" name="nim" class="form-control" placeholder="Contoh: 24448890" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama_mhs" class="form-control" placeholder="Masukkan nama mahasiswa" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat lengkap rumah..." required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Program Studi</label>
                                <select class="form-select" name="prodi_id" required>
                                    <option value="">-- Pilih Prodi --</option>
                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                        <option value="<?= $row['id']; ?>">
                                            <?= htmlspecialchars($row['nama_prodi']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary px-4" name="submit">Simpan Data</button>
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