<?php
session_start();
require 'functions.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$articles = getAllArticles();

function isActive($filename) {
    return basename($_SERVER['PHP_SELF']) == $filename ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kelola Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }
        .sidebar {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100vh;
            width: 240px;
            background-color: rgb(17, 49, 79);
            color: white;
            position: fixed;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 1001;
        }
        .sidebar h5 {
            padding: 20px 15px 10px;
            margin: 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: -10px;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background 0.2s;
        }
        .sidebar a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .sidebar a.active,
        .sidebar a:hover {
            background-color: rgb(28, 69, 105);
        }
        .sidebar .footer {
            padding: 15px;
            font-size: 0.9em;
            background-color: rgb(5, 35, 63);
        }
        .topbar {
            position: fixed;
            left: 240px;
            right: 0;
            height: 60px;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            z-index: 1000;
        }
        .toggle-icon {
            font-size: 24px;
            cursor: pointer;
            margin-left: 10px;
            color: #333;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-toggle {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #555;
        }
        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
            display: none;
            min-width: 160px;
            z-index: 1001;
        }
        .dropdown-menu a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
        }
        .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .main-content {
            margin-left: 240px;
            margin-top: 60px;
            padding: 30px;
            background-color: #ffffff;
            min-height: calc(100vh - 60px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin: 80px 30px 30px 270px;
            width: calc(100% - 300px);
        }
        h2 {
            font-size: 1.8rem;
            margin-bottom: 5px;
            color: #333;
        }
        p {
            color: #666;
            margin-bottom: 25px;
        }
        .btn-kategori-baru {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            text-decoration: none;
        }
        .btn-kategori-baru:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: white;
        }
        .btn-kategori-baru i {
            margin-right: 8px;
        }
        #tabelArtikel_wrapper .dataTables_filter input {
            width: 200px !important;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-sm i {
            margin-right: 5px;
            font-size: 0.8rem;
        }
        .btn-sm {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div>
            <h5>MENU UTAMA</h5>
            <a href="index.php" class="<?= isActive('index.php') ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="artikel.php" class="<?= isActive('artikel.php') ?>">
                <i class="fas fa-file-alt"></i> Artikel
            </a>
            <a href="kategori.php" class="<?= isActive('kategori.php') ?>">
                <i class="fas fa-bookmark"></i> Kategori
            </a>
            <a href="penulis.php" class="<?= isActive('penulis.php') ?>">
                <i class="fas fa-user"></i> Penulis
            </a>
        </div>
        <div class="footer">
            Logged in as:<br>
            <?= htmlspecialchars($email); ?>
        </div>
    </div>

    <div class="topbar">
        <i class="fas fa-bars toggle-icon" onclick="toggleSidebar()"></i>
        <div class="dropdown">
            <button class="dropdown-toggle"><i class="fas fa-user-circle fa-lg"></i></button>
            <div class="dropdown-menu">
                <a href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
            </div>
        </div>
    </div>
    <div class="main-content">
        <h2>Artikel</h2>
        <p>Silakan kelola artikel.</p>

        <a href="tambah_artikel.php" class="btn btn-primary mb-3">
            <i class="fas fa-file-lines"></i> Artikel Baru
        </a>

        <table id="tabelArtikel" class="table table-bordered table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($articles)): ?>
                    <tr><td colspan="7" class="text-center">Belum ada artikel.</td></tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($articles as $article): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('j F Y H:i', strtotime($article['date'])); ?></td>
                            <td><?= htmlspecialchars($article['title']); ?></td>
                            <td><?= htmlspecialchars($article['categories_name'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($article['authors_nickname'] ?? '-'); ?></td>
                            <td>
                                <?php
                                $imgPath = 'img/' . $article['picture'];
                                if (!empty($article['picture']) && file_exists($imgPath)): ?>
                                    <img src="<?= $imgPath ?>" alt="Gambar Artikel" width="150">
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="edit_artikel.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-warning" title="Ubah">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapus_artikel.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tabelArtikel').DataTable({
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
                language: {
                    search: "",
                    searchPlaceholder: "Search article...", // Perubahan di sini
                    lengthMenu: "Tampilkan _MENU_ entri",
                    zeroRecords: "Tidak ditemukan data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    infoEmpty: "Tidak ada entri",
                    infoFiltered: "(difilter dari _MAX_ entri)",
                    paginate: {
                        next: "→",
                        previous: "←"
                    }
                }
            });
        });

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const topbar = document.querySelector('.topbar');

            if (sidebar.style.display === 'none') {
                sidebar.style.display = 'flex';
                mainContent.style.margin = '80px 30px 30px 270px';
                mainContent.style.width = 'calc(100% - 300px)';
                topbar.style.left = '240px';
            } else {
                sidebar.style.display = 'none';
                mainContent.style.margin = '80px 30px 30px 30px';
                mainContent.style.width = 'calc(100% - 60px)';
                topbar.style.left = '0';
            }
        }
    </script>
</body>
</html>