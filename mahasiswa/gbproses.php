<?php
session_start();
// Proteksi: Hanya user login yang bisa menjalankan proses ini
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include("../koneksi.php");
?>
<?php
// create 
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi_id = $_POST['prodi_id'];
    $sql = "INSERT INTO mahasiswa(nim,nama_mhs,tgl_lahir,alamat, prodi_id) VALUES ('$nim','$nama_mhs','$tgl_lahir','$alamat','$prodi_id')";

    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menambah data: " . $koneksi->error;
    }
}
?>

<?php
// edit
if (isset($_POST['update'])) {
    // Ambil data dari POST, bukan GET
    $nim = intval($_POST['nim']);
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $prodi_id = $_POST['prodi_id'];

    $sql = "UPDATE mahasiswa 
            SET nama_mhs='$nama_mhs', 
                tgl_lahir='$tgl_lahir', 
                alamat='$alamat',
                prodi_id='$prodi_id'
            WHERE nim=$nim";

    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Maaf, data gagal diubah: " . $koneksi->error;
    }
}
?>

<?php
// --- PROSES DELETE ---
// Pastikan proses delete hanya jalan jika ada parameter 'hapus_nim' di URL
if (isset($_GET['nim'])) {
    $nim = mysqli_real_escape_string($koneksi, $_GET['nim']);

    $sql = "DELETE FROM mahasiswa WHERE nim='$nim'";
    if ($koneksi->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $koneksi->error;
    }
}
?>


