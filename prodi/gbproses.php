<?php
session_start();

// 1. Proteksi: Pastikan hanya user yang login yang bisa menjalankan proses database
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include("../koneksi.php");
?>

<?php
// create 
if (isset($_POST['submit'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $keterangan = $_POST['keterangan'];
    $sql = "INSERT INTO prodi(nama_prodi,jenjang,keterangan) VALUES ('$nama_prodi','$jenjang','$keterangan')";

    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambah data prodi: " . $koneksi->error;
    }
}
?>

<?php
// edit
if (isset($_POST['update'])) {
    // Ambil data dari POST, bukan GET
    $id = intval($_POST['id']);
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $keterangan = $_POST['keterangan'];

    $sql = "UPDATE prodi 
            SET nama_prodi='$nama_prodi', 
                jenjang='$jenjang', 
                keterangan='$keterangan' 
            WHERE id=$id";

    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Maaf, data prodi gagal diubah: " . $koneksi->error;
    }
}
?>

<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM prodi WHERE id=$id";
    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data prodi: " . $koneksi->error;
    }
}
?>


