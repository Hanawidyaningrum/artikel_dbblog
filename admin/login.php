<?php
session_start();
require 'functions.php'; // Pastikan file functions.php sudah ada dan berisi koneksi $conn

// LOGIN
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // !!! PENTING: Gunakan prepared statements atau setidaknya mysqli_real_escape_string untuk keamanan !!!
    // Saat ini rentan terhadap SQL Injection. Untuk perbaikan cepat, saya tambahkan escape string.
    // Namun, SANGAT DISARANKAN untuk menggunakan prepared statements.
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password); // Jika password tidak di-hash, ini membantu. Jika di-hash, gunakan password_verify.

    $query = "SELECT id, nickname, email, password FROM author WHERE LOWER(email) = LOWER('$email') AND password = '$password'";
    // ^^^ Tambahkan 'id' di SELECT query agar bisa diambil

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // !!! Jika Anda menggunakan password_hash() saat registrasi, Anda HARUS menggunakan password_verify() di sini:
        // if (password_verify($password, $row['password'])) {
        //     $_SESSION['login'] = true;
        //     $_SESSION['nickname'] = $row['nickname'];
        //     $_SESSION['email'] = $row['email'];
        //     $_SESSION['author_id'] = $row['id']; // <--- Tambahkan baris ini!
        //     header("Location: index.php");
        //     exit;
        // } else {
        //     $error = "Email atau password salah!"; // Password tidak cocok
        // }
        
        // Karena kode Anda saat ini tidak menggunakan hash, kita asumsikan password cocok langsung
        $_SESSION['login'] = true;
        $_SESSION['nickname'] = $row['nickname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['author_id'] = $row['id']; // <--- INI BARIS KRUSIAL YANG DITAMBAHKAN!
        
        header("Location: index.php"); // Atau ke dashboard/artikel.php jika itu halaman utama setelah login
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}

// REGISTRASI
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $ulangi  = $_POST['ulangi_password'];

    // !!! PENTING: Hash password saat registrasi untuk keamanan
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($password !== $ulangi) {
        $reg_error = "Konfirmasi password tidak cocok!";
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM author WHERE email = '$email'");
        if (mysqli_num_rows($cek) > 0) {
            $reg_error = "Email sudah terdaftar!";
        } else {
            // Gunakan $hashed_password jika Anda sudah mengimplementasikan password_hash()
            $query = "INSERT INTO author (nickname, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
                $reg_success = "Registrasi berhasil! Silakan login.";
            } else {
                $reg_error = "Registrasi gagal. Silakan coba lagi.";
            }
        }
    }
}

// RESET PASSWORD
if (isset($_POST['reset'])) {
    $email = strtolower(trim($_POST['email']));
    $newpass = $_POST['new_password'];

    // !!! PENTING: Hash password baru saat reset untuk keamanan
    // $hashed_newpass = password_hash($newpass, PASSWORD_DEFAULT);

    $cek = mysqli_query($conn, "SELECT * FROM author WHERE email = '$email'");
    if (mysqli_num_rows($cek) === 1) {
        // Gunakan $hashed_newpass jika Anda sudah mengimplementasikan password_hash()
        $query = "UPDATE author SET password = '$newpass' WHERE email = '$email'";
        if (mysqli_query($conn, $query)) {
            $reset_success = "Password berhasil diperbarui!";
        } else {
            $reset_error = "Gagal memperbarui password.";
        }
    } else {
        $reset_error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login, Registrasi, Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: rgb(8, 32, 57);
            display: flex; /* Menggunakan flexbox untuk memposisikan konten di tengah */
            justify-content: center; /* Horizontally center */
            align-items: center; /* Vertically center */
            min-height: 100vh; /* Memastikan body mengisi seluruh tinggi viewport */
            margin: 0;
            padding: 20px; /* Padding agar tidak terlalu mepet ke tepi layar kecil */
            box-sizing: border-box; /* Pastikan padding tidak menambah lebar/tinggi elemen */
        }
        .form-container { /* Tambahkan kelas ini untuk membungkus judul dan form */
            max-width: 500px; /* Batasi lebar container keseluruhan */
            width: 100%;
        }
        .form-card {
            padding: 30px;
            font-size: 1.1rem;
            margin-bottom: 20px; /* Kurangi margin bawah agar tidak terlalu jauh dari judul */
            background-color: #fff; /* Pastikan background card putih */
            border-radius: 8px; /* Sudut membulat pada card */
        }
        .login-input {
            height: 45px;
            font-size: 1rem;
        }
        .login-btn {
            height: 45px;
            font-size: 1.1rem;
            background-color: rgb(21, 70, 109);
            color: white;
            border: none;
        }
        .login-btn:hover {
            background-color: rgb(15, 60, 95);
        }
        .card-header-custom {
            background-color: rgb(21, 70, 109);
            color: white;
            text-align: center;
            font-size: 1.4rem;
            padding: 10px;
            border-radius: 8px 8px 0 0; /* Sudut membulat hanya di atas */
        }
        .switch-link {
            color: #15466d;
            cursor: pointer;
            text-decoration: none; /* Hapus underline default */
        }
        .switch-link:hover {
            text-decoration: underline; /* Tambahkan underline saat hover */
        }
        #registerForm, #resetForm {
            display: none;
        }
        .welcome-text {
            color: white;
            text-align: center;
            margin-bottom: 30px; /* Jarak antara teks selamat datang dan form */
        }
        .welcome-text h1 {
            font-size: 2rem; /* Mengurangi ukuran font lebih lanjut */
            font-weight: 700;
            margin-bottom: 10px;
            /* Hapus properti white-space, overflow, dan text-overflow */
            /* agar teks bisa pecah baris jika tidak muat, tanpa elipsis */
            /* Jika Anda tetap ingin satu baris dan elipsis, kembalikan properti ini */
            /* dan coba kurangi font-size lagi atau perbesar kolom */
        }
        .welcome-text p {
            font-size: 1.1rem;
            line-height: 1.5;
        }
        /* Responsif untuk layar kecil */
        @media (max-width: 576px) {
            .welcome-text h1 {
                font-size: 1.6rem; /* Lebih kecil lagi di layar sangat kecil */
            }
            .welcome-text p {
                font-size: 0.95rem;
            }
            .form-card {
                padding: 20px;
            }
            .login-input, .login-btn {
                height: 40px;
                font-size: 1rem;
            }
            .card-header-custom {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 form-container"> 

            <div class="welcome-text">
                <h1>Selamat Datang di Ruang Kata</h1>
                <p>Menelusuri inspirasi dari wisata, budaya, teknologi, dan pendidikan di balik setiap paragraf.</p>
            </div>

            <div class="card shadow form-card" id="loginForm">
                <div class="card-header card-header-custom">Form Login</div>
                <div class="card-body">
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control login-input" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control login-input" required />
                        </div>
                        <button type="submit" name="login" class="btn login-btn w-100">Login</button>
                        <div class="text-center mt-3">
                            <span class="switch-link" onclick="showReset()">Lupa Password?</span><br>
                            Belum punya akun? <span class="switch-link" onclick="showRegister()">Daftar</span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow form-card" id="registerForm">
                <div class="card-header card-header-custom">Form Registrasi</div>
                <div class="card-body">
                    <?php if (isset($reg_error)) : ?>
                        <div class="alert alert-danger"><?= $reg_error ?></div>
                    <?php endif; ?>
                    <?php if (isset($reg_success)) : ?>
                        <div class="alert alert-success"><?= $reg_success ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" name="username" class="form-control login-input" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control login-input" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control login-input" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ulangi Password:</label>
                            <input type="password" name="ulangi_password" class="form-control login-input" required />
                        </div>
                        <button type="submit" name="register" class="btn login-btn w-100">Daftar</button>
                        <div class="text-center mt-3">
                            Sudah punya akun? <span class="switch-link" onclick="showLogin()">Login</span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow form-card" id="resetForm">
                <div class="card-header card-header-custom">Reset Password</div>
                <div class="card-body">
                    <?php if (isset($reset_error)) : ?>
                        <div class="alert alert-danger"><?= $reset_error ?></div>
                    <?php endif; ?>
                    <?php if (isset($reset_success)) : ?>
                        <div class="alert alert-success"><?= $reset_success ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" name="email" class="form-control login-input" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru:</label>
                            <input type="password" name="new_password" class="form-control login-input" required />
                        </div>
                        <button type="submit" name="reset" class="btn login-btn w-100">Ubah Password</button>
                        <div class="text-center mt-3">
                            Kembali ke <span class="switch-link" onclick="showLogin()">Login</span>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Saat halaman dimuat, tampilkan form login
    window.onload = function () {
        showLogin();

        // Tampilkan alert dari PHP jika ada
        <?php if (isset($reg_error) || isset($reg_success) || isset($reset_error) || isset($reset_success) || isset($error)) : ?>
            // Jika ada pesan registrasi/reset, tampilkan form yang sesuai
            <?php if (isset($reg_error) || isset($reg_success)) : ?>
                showRegister();
            <?php elseif (isset($reset_error) || isset($reset_success)) : ?>
                showReset();
            <?php else : ?>
                showLogin(); // Kembali ke login jika ada error login
            <?php endif; ?>
        <?php endif; ?>
    };

    function showRegister() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('resetForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'block';
    }

    function showLogin() {
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('resetForm').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
    }

    function showReset() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('resetForm').style.display = 'block';
    }
</script>
</body>
</html>