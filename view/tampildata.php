<?php
require_once('../koneksi.php');

$data = new mahasiswa();
$isi = $data->tampil_data();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Data Mahasiswa</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Aksi</th> <!-- Kolom untuk ikon hapus -->
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($isi as $key => $value) { ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['nama'] ?></td>
                    <td><?= $value['prodi'] ?></td>
                    <td><?= $value['nim'] ?></td>
                    <td>
                        <!-- Tombol hapus -->
                        <a href="hapusdata.php?id=<?= $value['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                        <!-- Tombol edit -->
                        <a href="updatedata.php?id=<?= $value['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Tambahkan Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
