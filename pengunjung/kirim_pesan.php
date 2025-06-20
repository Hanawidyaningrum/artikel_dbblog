<?php
require '../admin/functions.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);
    $stmt = mysqli_prepare($conn, "INSERT INTO kontak (nama, email, pesan) VALUES (?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $nama, $email, $pesan);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Pesan berhasil dikirim!');
                    window.location.href = 'kontak.php'; // Redirect kembali ke halaman kontak
                  </script>";
        } else {
            error_log("Gagal menyimpan pesan: " . mysqli_error($conn));
            echo "<script>
                    alert('Terjadi kesalahan saat mengirim pesan. Mohon coba lagi.');
                    window.location.href = 'kontak.php';
                  </script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Gagal menyiapkan statement: " . mysqli_error($conn));
        echo "<script>
                alert('Terjadi kesalahan sistem. Mohon coba lagi nanti.');
                window.location.href = 'kontak.php';
              </script>";
    }
} else {
    header("Location: kontak.php");
    exit();
}
?>