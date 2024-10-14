<?php
// Pastikan file koneksi ke database sudah ada dan bisa digunakan
require_once('../koneksi.php');

// Cek apakah request yang masuk adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Validasi data (misalnya cek apakah semua field diisi)
    if (empty($id) || empty($nama) || empty($nim) || empty($prodi)) {
        echo "Semua field harus diisi!";
        exit;
    }

    // Buat instance dari class mahasiswa
    $mahasiswa = new mahasiswa();

    // Proses update data
    $result = $mahasiswa->update_data($id, $nama, $nim, $prodi);

    // Cek apakah proses update berhasil
    if ($result) {
        // Redirect ke halaman tampildata.php jika berhasil
        header('Location: tampildata.php');
        exit;
    } else {
        echo "Gagal mengupdate data.";
    }
} else {
    echo "Invalid request method.";
}
?>
