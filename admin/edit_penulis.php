<?php
session_start();
require 'functions.php'; // Pastikan path ini benar, jika edit_penulis.php berada di admin/ dan functions.php di root, maka harus '../functions.php'

// Cek apakah user sudah login
// Jika ini adalah halaman admin, Anda mungkin perlu memeriksa $_SESSION['role'] juga
if (!isset($_SESSION['login'])) { // Asumsi 'login' adalah session key yang menandakan user sudah login
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit;
}

// Pastikan ada ID penulis yang dikirim melalui URL (GET)
if (!isset($_GET['id'])) {
    header("Location: penulis.php"); // Redirect kembali ke daftar penulis jika tidak ada ID
    exit;
}

$id = $_GET['id'];
$author = getAuthorById($id); // Mengambil data penulis berdasarkan ID

// Jika penulis tidak ditemukan di database
if (!$author) {
    echo "<script>alert('Penulis tidak ditemukan!');</script>";
    echo "<script>window.location.href = 'penulis.php';</script>"; // Redirect ke daftar penulis
    exit;
}

// Logika untuk menangani update penulis (ketika form disubmit)
if (isset($_POST['btn_update_penulis'])) {
    // Memanggil fungsi updateAuthor dari functions.php
    // Fungsi updateAuthor sudah dirancang untuk menangani hashing password jika diisi
    if (updateAuthor($_POST)) {
        echo "<script>alert('Penulis berhasil diubah!');</script>";
        echo "<script>window.location.href = 'penulis.php';</script>"; // Redirect ke daftar penulis setelah berhasil
    } else {
        // Jika update gagal, fungsi updateAuthor sudah menampilkan alert dengan pesan errornya.
        // Anda bisa menambahkan log di sini jika perlu untuk debugging.
        // Cukup refresh halaman agar form menampilkan data terbaru (jika ada perubahan lain)
        echo "<script>window.location.href = 'edit_penulis.php?id=" . $id . "';</script>";
    }
    exit; // Pastikan keluar setelah redirect
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Form untuk mengubah penulis" />
    <meta name="author" content="Nama Anda" />
    <title>Ubah Penulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    <style type="text/css">
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
            margin-bottom: 30px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Ubah Penulis</h2>
        <hr>
        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($author['id']); ?>">

            <div class="mb-3 mt-3">
                <label for="nickname" class="form-label">Nama Panggilan:</label>
                <input type="text" class="form-control" id="nickname" name="nickname" required value="<?= htmlspecialchars($author['nickname']); ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($author['email']); ?>">
            </div>

            <div class="mb-3 mt-3">
                <label for="password" class="form-label">Password (kosongkan jika tidak ingin mengubah):</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru jika ingin mengubah">
                <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah password penulis.</div>
            </div>

            <div class="mb-3 mt-3 d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary" name="btn_update_penulis"><i class="bi bi-arrow-repeat"></i> Update</button>
                <a href="penulis.php" class="btn btn-secondary"><i class="bi bi-x-lg"></i> Batal</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>