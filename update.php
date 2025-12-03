<?php
// Hubungkan ke file koneksi database
require 'koneksi.php';

// Cek apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Ambil data dan lakukan sanitasi (PENTING!)
    // nim_lama digunakan untuk menentukan baris mana yang akan diupdate (Primary Key)
    $nim_lama   = $koneksi->real_escape_string($_POST['nim_lama']);

    // Data yang akan diupdate
    $nama_mhs   = $koneksi->real_escape_string($_POST['nama_mhs']);
    $tgl_lahir  = $_POST['tgl_lahir']; // Tipe date tidak perlu sanitasi real_escape_string
    $alamat     = $koneksi->real_escape_string($_POST['alamat']);

    // 2. Buat Query UPDATE
    $sql = "UPDATE mahasiswa SET 
                nama_mhs = '$nama_mhs', 
                tgl_lahir = '$tgl_lahir', 
                alamat = '$alamat' 
            WHERE nim = '$nim_lama'"; // Kunci update menggunakan nim

    // 3. Jalankan Query
    $query = $koneksi->query($sql);

    // 4. Periksa hasil query
    if ($query) {
        // Jika berhasil, redirect kembali ke halaman daftar data (index.php)
        header("Location: index.php?status=update_sukses");
        exit(); // Hentikan eksekusi script
    } else {
        // Tampilkan pesan error jika update gagal
        echo "Gagal mengupdate data Mahasiswa dengan NIM **$nim_lama**. Error: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    // Jika akses tidak melalui form POST (misalnya langsung diakses di browser)
    echo "Akses tidak diizinkan. Mohon update data melalui formulir edit (edit.php).";
}
