<?php
// Pastikan file koneksi.php sudah tersedia
require 'koneksi.php';

// Cek apakah parameter NIM sudah dikirim melalui URL
if (!isset($_GET['nim'])) {
    // Jika NIM tidak ada, kembali ke halaman utama
    header("Location: index.php");
    exit();
}

// Ambil dan sanitasi parameter NIM
$nim = $koneksi->real_escape_string($_GET['nim']);

// Query untuk mengambil data mahasiswa berdasarkan NIM
$result = $koneksi->query("SELECT * FROM mahasiswa WHERE nim = '$nim'");

// Cek apakah data dengan NIM tersebut ditemukan
if ($result->num_rows == 0) {
    echo "Data Mahasiswa tidak ditemukan.";
    exit();
}

// Ambil data lama untuk diisikan ke dalam form
$data_lama = $result->fetch_assoc();

// Tutup koneksi setelah selesai mengambil data
$koneksi->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5" style="max-width: 720px;">
        <h2 class="mb-4">Edit Data Mahasiswa: <?= htmlspecialchars($data_lama['nim']) ?></h2>

        <form action="update_process.php" method="POST">
            <input type="hidden" name="nim_lama" value="<?= htmlspecialchars($data_lama['nim']) ?>">

            <div class="row mb-3">
                <label for="inputNim" class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNim" name="nim" value="<?= htmlspecialchars($data_lama['nim']) ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputNamaMhs" class="col-sm-3 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNamaMhs" name="nama_mhs" value="<?= htmlspecialchars($data_lama['nama_mhs']) ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputTglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="inputTglLahir" name="tgl_lahir" value="<?= htmlspecialchars($data_lama['tgl_lahir']) ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputAlamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="inputAlamat" name="alamat" rows="4" required><?= htmlspecialchars($data_lama['alamat']) ?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-success">Update Data</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>