<?php
// kontak.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kontak – Ruang Kata</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #f9fafb;
      color: #333;
    }

    .site-header {
      background: linear-gradient(90deg, #082e4d, #0d4a7b);
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .site-header h1 {
      margin: 0;
      font-size: 1.5rem;
    }

    .site-header nav a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: 500;
    }

    .site-header nav a:hover {
      text-decoration: underline;
    }

    .kontak-section {
      padding: 40px 24px;
      max-width: 800px;
      margin: auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
      margin-top: 40px;
      margin-bottom: 40px;
    }

    .kontak-section h2 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #0d4a7b;
    }

    .kontak-section p {
      margin-bottom: 20px;
    }

    .kontak-section form label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 500;
    }

    .kontak-section form input,
    .kontak-section form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      font-family: 'Inter', sans-serif;
    }

    .kontak-section form button {
      margin-top: 16px;
      padding: 10px 20px;
      background: linear-gradient(90deg, #082e4d, #0d4a7b);
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .kontak-section form button:hover {
      background: linear-gradient(90deg, #0a3a5e, #145a8f);
    }

    .kontak-info {
      margin-top: 40px;
      padding-top: 20px;
      border-top: 1px solid #ddd;
    }

    .kontak-info p {
      margin: 6px 0;
    }

    footer {
      text-align: center;
      background: linear-gradient(90deg, #082e4d, #0d4a7b);
      color: #ddd;
      padding: 30px;
      margin-top: 40px;
    }

    footer a {
      color: #fff;
      text-decoration: none;
      font-weight: 500;
    }
  </style>
</head>
<body>

  <header class="site-header">
    <h1>Ruang Kata</h1>
    <nav>
      <a href="artikel_pengunjung.php">Beranda</a>
      <a href="tentang.php">Tentang</a>
      <a href="kontak.php">Kontak</a>
    </nav>
  </header>

  <section class="kontak-section">
    <h2>Hubungi Kami</h2>
    <p>Silakan kirim pertanyaan, kritik, atau saran Anda melalui formulir berikut atau hubungi kami langsung lewat media sosial.</p>

    <form action="kirim_pesan.php" method="POST">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="pesan">Pesan</label>
      <textarea id="pesan" name="pesan" rows="5" required></textarea>

      <button type="submit">Kirim Pesan</button>
    </form>

    <div class="kontak-info">
      <p>Email: <a href="mailto:hanawidyaningrum212@gmail.com">hanawidyaningrum212@gmail.com</a></p>
      <p><strong>Instagram:</strong> <a href="https://hanawidyan/ruang.kata" target="_blank">@hanawidyan</a></p>
      <p><strong>WhatsApp:</strong> <a href="https://wa.me/6282141315360" target="_blank">+62 821-4131-5360</a></p>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Ruang Kata</p>
    <p>Dibuat dengan hati, ditulis dengan rasa. Terima kasih telah membaca 🌸</p>
  </footer>

</body>
</html>