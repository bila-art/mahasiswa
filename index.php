<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik - Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5" style="max-width: 900px;">
        <h1 class="mb-4">List Data Mahasiswa</h1>
        <a href="create.php" class="btn btn-primary mb-3">Input Data Mahasiswa</a>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Alamat</th>
                    <th scope="col" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Pastikan file koneksi.php sudah tersedia dan berisi koneksi MySQLi
                require 'koneksi.php';

                // Query untuk mengambil semua data dari tabel 'mahasiswa'
                // Diasumsikan kolom Primary Key adalah 'nim'
                $query = "SELECT nim, nama_mhs, tgl_lahir, alamat FROM mahasiswa ORDER BY nim ASC";
                $hasil = $koneksi->query($query);

                if ($hasil->num_rows > 0) {
                    while ($row = $hasil->fetch_assoc()) {
                ?>
                        <tr>
                            <th scope="row"><?= htmlspecialchars($row['nim']) ?></th>
                            <td><?= htmlspecialchars($row['nama_mhs']) ?></td>
                            <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td>
                                <a href="edit.php?nim=<?= urlencode($row['nim']) ?>" class="btn btn-warning btn-sm">Edit</a>

                                <a href="delete.php?nim=<?= urlencode($row['nim']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa dengan NIM: <?= $row['nim'] ?>?')">Hapus</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    // Tampilkan pesan jika tidak ada data
                    echo '<tr><td colspan="5" class="text-center">Tidak ada data mahasiswa.</td></tr>';
                }

                // Tutup koneksi (opsional, tapi disarankan)
                $koneksi->close();
                ?>
            </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>