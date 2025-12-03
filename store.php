<?php
// Pastikan file koneksi.php sudah tersedia
require 'koneksi.php';

// Cek apakah data form telah dikirim melalui method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Ambil data dari form dan sanitasi (sesuai field tabel mahasiswa)
    // Gunakan real_escape_string untuk mencegah SQL Injection
    $nim        = $koneksi->real_escape_string($_POST['nim']);
    $nama_mhs   = $koneksi->real_escape_string($_POST['nama_mhs']);
    $tgl_lahir  = $_POST['tgl_lahir']; // Tipe date, sanitasi string lebih lanjut tidak diperlukan
    $alamat     = $koneksi->real_escape_string($_POST['alamat']);

    // 2. Buat query INSERT (sesuai tabel dan kolom mahasiswa)
    $sql = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat)
            VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat')";

    $query = $koneksi->query($sql);

    // 3. Cek hasil
    if ($query) {
        // Redirect langsung ke halaman index dengan pesan status sukses
        header("Location: index.php?status=insert_sukses");
        exit(); // Penting: Hentikan eksekusi script setelah header redirect
    } else {
        // Tampilkan pesan error SQL jika gagal
        echo "Gagal menyimpan data Mahasiswa. Error: " . $koneksi->error;
    }

    // 4. Tutup koneksi
    $koneksi->close();
} else {
    echo "Akses tidak diizinkan. Mohon kirim data melalui form input (create.php).";
    // Opsional: Redirect ke halaman form input
    // header("Location: create.php");
    // exit();
}
