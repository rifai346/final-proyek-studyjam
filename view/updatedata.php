<?php
session_start(); // Pastikan session diinisialisasi
require_once('../koneksi.php');

$data = new mahasiswa();

// Periksa apakah ID ada di URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Ambil data mahasiswa berdasarkan ID
    $mahasiswa = $data->tampil_data_by_id($id);
    
    if ($mahasiswa) {
        // Simpan data mahasiswa ke dalam session
        $_SESSION['mahasiswa'] = $mahasiswa;
    } else {
        header('Location: tampildata.php');
        exit;
    }
} else {
    header('Location: tampildata.php');
    exit;
}

// Proses pembaruan data jika formulir disubmit
if (isset($_POST['nama']) && isset($_POST['nim']) && isset($_POST['prodi'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Memperbarui data di database
    $data->update_data($id, $nama, $nim, $prodi);
    
    // Kosongkan session setelah update
    unset($_SESSION['mahasiswa']);
    
    // Redirect setelah update
    header('Location: tampildata.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Data Mahasiswa</h2>

        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= isset($_SESSION['mahasiswa']['nama']) ? $_SESSION['mahasiswa']['nama'] : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= isset($_SESSION['mahasiswa']['nim']) ? $_SESSION['mahasiswa']['nim'] : '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="prodi" class="form-label">Prodi</label>
                <input type="text" class="form-control" id="prodi" name="prodi" value="<?= isset($_SESSION['mahasiswa']['prodi']) ? $_SESSION['mahasiswa']['prodi'] : '' ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
