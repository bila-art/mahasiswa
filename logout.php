<?php
// Memulai session agar sistem tahu session mana yang akan dihapus
session_start();

// Menghapus semua variabel session yang ada
$_SESSION = [];

// Menghancurkan session secara total
session_unset();
session_destroy();

// Mengarahkan pengguna kembali ke halaman login setelah logout berhasil
header("Location: login.php");
exit;
