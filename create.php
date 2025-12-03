<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5" style="max-width: 720px;">

        <h2 class="mb-4">Input Data Mahasiswa Baru</h2>

        <form action="store.php" method="POST">

            <div class="row mb-3">
                <label for="inputNim" class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNim" name="nim" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputNamaMhs" class="col-sm-3 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputNamaMhs" name="nama_mhs" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputTglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="inputTglLahir" name="tgl_lahir">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputAlamat" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="inputAlamat" name="alamat" rows="4" required></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <button type="reset" class="btn btn-secondary">Reset Form</button>
                    <a href="index.php" class="btn btn-outline-primary">Kembali ke List Data</a>
                </div>
            </div>

        </form>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>