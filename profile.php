<?php
session_start();
require 'koneksi.php';

// Proteksi Halaman: Jika belum login, arahkan ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];

// Ambil data user terbaru dari database
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

// Proses Update Profil
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $password_baru = $_POST['password'];

    // Jika password baru diisi, maka update nama dan password
    if (!empty($password_baru)) {
        $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET nama = '$nama', password = '$hashed_password' WHERE id = $id";
    } else {
        // Jika password kosong, hanya update nama saja
        $sql = "UPDATE users SET nama = '$nama' WHERE id = $id";
    }

    if (mysqli_query($koneksi, $sql)) {
        $_SESSION['nama'] = $nama; // Update nama di session agar di navbar ikut berubah
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        $error = "Gagal memperbarui profil.";
    }
}

$base = '.'; // Path untuk navbar karena file ini di root
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - <?= htmlspecialchars($user['nama']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <?php include 'partials/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow border-0">
                    <div class="card-header bg-dark text-white py-3 text-center">
                        <h4 class="mb-0">Pengaturan Profil</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3 text-center">
                                <i class="bi bi-person-circle display-1 text-secondary"></i>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Email</label>
                                <input type="email" class="form-control bg-light" value="<?= $user['email']; ?>" readonly>
                                <div class="form-text">Email digunakan sebagai identitas login dan tidak dapat diubah.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user['nama']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
                            </div>

                            <hr class="my-4">

                            <div class="d-grid gap-2">
                                <button type="submit" name="update" class="btn btn-primary btn-lg">Simpan Perubahan</button>
                                <a href="index.php" class="btn btn-outline-secondary">Batal</a>
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