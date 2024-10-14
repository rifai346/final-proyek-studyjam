<?php
require_once('../koneksi.php');

$mahasiswa = new mahasiswa();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($mahasiswa->hapus_data($id)) {
        header('Location: tampildata.php');
        exit;
    } else {
        echo "Gagal menghapus data";
    }
} else {
    echo "ID tidak ditemukan";
}
?>
