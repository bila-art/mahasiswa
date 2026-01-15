<?php
session_start();
// 1. Proteksi: Jika belum login, tendang ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
require('../koneksi.php');
$query = "SELECT mahasiswa.*, prodi.nama_prodi 
              FROM mahasiswa 
              JOIN prodi ON mahasiswa.prodi_id = prodi.id";
$sql = $koneksi->query($query);
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

    <?php include '../partials/navbar.php'; ?>

    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="fw-bold m-0">List Data Mahasiswa</h2>
                    <a href="create.php" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Tambah Mahasiswa
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>NO</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Prodi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sql as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><span class="badge bg-secondary"><?= $row['nim']; ?></span></td>
                                    <td class="fw-bold"><?= htmlspecialchars($row['nama_mhs']); ?></td>
                                    <td><?= date('d M Y', strtotime($row['tgl_lahir'])); ?></td>
                                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                                    <td><span class="text-primary fw-semibold"><?= htmlspecialchars($row['nama_prodi']); ?></span></td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="view.php?nim=<?= $row['nim']; ?>" class="btn btn-success btn-sm">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="edit.php?nim=<?= $row['nim']; ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="gbproses.php?nim=<?= $row['nim']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data <?= $row['nama_mhs']; ?>?');">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>