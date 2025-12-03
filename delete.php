<?php
// Pastikan file koneksi.php sudah tersedia
require 'koneksi.php';

// Pastikan parameter NIM ada di URL
if (isset($_GET['nim'])) {

    // 1. Ambil dan sanitasi parameter NIM
    // Gunakan real_escape_string untuk mencegah SQL Injection
    $nim = $koneksi->real_escape_string($_GET['nim']);

    // 2. Query Hapus data dari tabel 'mahasiswa' berdasarkan 'nim'
    $sql = "DELETE FROM mahasiswa WHERE nim = '$nim'";

    $query = $koneksi->query($sql);

    if ($query) {
        // 3. Redirect kembali ke halaman daftar data setelah berhasil
        // Tambahkan pesan status sukses (opsional)
        header("Location: index.php?status=hapus_sukses");
        exit();
    } else {
        // Tampilkan pesan error jika gagal
        echo "Gagal menghapus data Mahasiswa dengan NIM **$nim**. Error: " . $koneksi->error;
    }
} else {
    // Jika parameter NIM tidak ditemukan
    echo "NIM Mahasiswa tidak ditemukan di URL.";
    // Opsional: Redirect kembali ke index.php
    // header("Location: index.php?status=error_nim");
    // exit();
}

// Tutup koneksi (walaupun exit() di atas, ini adalah praktik yang baik jika tidak terjadi redirect)
if (isset($koneksi)) {
    $koneksi->close();
}
