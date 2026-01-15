<?php
session_start();

// 1. Proteksi Halaman: Jika belum login, tendang ke login.php di root
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
// 2. Set base path untuk navbar (naik satu tingkat karena berada di folder prodi)
$base = '..';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Prodi - Akademik System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <?php include '../partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Program Studi</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="gbproses.php">

                            <div class="mb-3">
                                <label for="nama_prodi" class="form-label fw-bold">Nama Prodi</label>
                                <input type="text" name="nama_prodi" class="form-control" id="nama_prodi" placeholder="Contoh: Teknik Rekayasa Perangkat Lunak" required>
                            </div>

                            <div class="mb-3">
                                <label for="jenjang" class="form-label fw-bold">Jenjang Pendidikan</label>
                                <select name="jenjang" id="jenjang" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih Jenjang --</option>
                                    <option value="D2">Diploma 2 (D2)</option>
                                    <option value="D3">Diploma 3 (D3)</option>
                                    <option value="D4">Diploma 4 (D4)</option>
                                    <option value="S1">Sarjana (S1)</option>
                                    <option value="S2">Magister (S2)</option>
                                </select>
                                <div class="form-text">Pilih jenjang sesuai program studi.</div>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Tambahkan deskripsi singkat prodi..."></textarea>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="index.php" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary px-4" name="submit">
                                    <i class="bi bi-save me-2"></i>Simpan Prodi
                                </button>
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