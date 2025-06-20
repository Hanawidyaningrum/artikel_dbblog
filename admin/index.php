<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Tangani jika session belum tersedia
$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : 'Pengguna';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'email@example.com';

// Include file functions.php
require 'functions.php'; // Pastikan path ini benar

// Fetch counts from the database using your new functions
$artikel_count = getArticleCount();
$kategori_count = getCategoryCount();
$penulis_count = getAuthorCount();

function isActive($filename) {
    return basename($_SERVER['PHP_SELF']) == $filename ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
        .card {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-body {
            font-size: 1.25rem;
            font-weight: bold;
            padding: 1.5rem;
        }
        .card-footer {
            background-color: rgba(0, 0, 0, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-footer i {
            font-size: 1rem;
        }
        .card-link {
            text-decoration: none;
        }
        .card.bg-primary { background-color: #0d6efd !important; }
        .card.bg-warning { background-color: #ffc107 !important; color: #212529 !important; }
        .card.bg-success { background-color: #198754 !important; }
        .card.bg-info { background-color: #0dcaf0 !important; color: #212529 !important; }
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
                <i class="fas fa-file-lines"></i> Artikel
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
        <h2>Dashboard</h2>
        <p>Selamat datang, <strong><?= htmlspecialchars($nickname); ?></strong>!</p>
        <p>Silakan pilih salah satu menu berikut:</p>
        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="artikel.php" class="card-link text-decoration-none">
                    <div class="card bg-primary text-white">
                        <div class="card-body">Artikel</div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <span><?= $artikel_count; ?> artikel</span> <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="kategori.php" class="card-link text-decoration-none">
                    <div class="card bg-warning text-white">
                        <div class="card-body">Kategori</div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <span><?= $kategori_count; ?> kategori</span> <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="penulis.php" class="card-link text-decoration-none">
                    <div class="card bg-success text-white">
                        <div class="card-body">Penulis</div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <span><?= $penulis_count; ?> penulis</span> <i class="fas fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script>
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

        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Menutup dropdown jika klik di luar
        window.addEventListener('click', function(e) {
            const profile = document.querySelector('.dropdown'); // Target dropdown class, not profile-dropdown
            if (!profile.contains(e.target)) {
                const dropdownMenu = profile.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdownMenu.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>