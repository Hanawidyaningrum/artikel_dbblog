<?php
// tentang.php
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang – Ruang Kata</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      background-color: #f9fafb;
      color: #333;
    }

    header {
      background: linear-gradient(90deg, #082e4d, #0d4a7b);
      color: white;
      padding: 16px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      font-size: 1.6rem;
      margin: 0;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
      font-weight: 500;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .tentang-container {
      max-width: 900px;
      margin: 60px auto;
      padding: 40px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .tentang-container h2 {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      color: #0d4a7b;
      margin-bottom: 20px;
    }

    .tentang-container p {
      font-size: 1.05rem;
      line-height: 1.8;
      text-align: justify;
      margin-bottom: 16px;
    }

    footer {
      background: linear-gradient(90deg, #082e4d, #0d4a7b);
      color: #eee;
      text-align: center;
      padding: 30px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

  <header>
    <h1>Ruang Kata</h1>
    <nav>
      <a href="artikel_pengunjung.php">Beranda</a>
      <a href="tentang.php">Tentang</a>
      <a href="kontak.php">Kontak</a>
    </nav>
  </header>

  <section class="tentang-container">
    <h2>Tentang Ruang Kata</h2>
    <p><strong>Ruang Kata</strong> adalah catatan perjalanan menyusuri tempat wisata, budaya lokal, inovasi teknologi, dan cerita pendidikan di berbagai sudut Indonesia.</p>
    <p>Blog ini seperti jurnal kecil yang memuat apa yang dilihat, dirasakan, dan dipelajari yang  menyajikan ragam perspektif dari pengalaman langsung, kisah unik di balik tradisi, hingga perkembangan inovasi dan ilmu pengetahuan.</p>
    <p>Kami percaya bahwa setiap tempat menyimpan cerita, dan setiap cerita layak untuk dibagikan. Ruang Kata hadir sebagai ruang narasi yang hangat, informatif, dan menginspirasi bagi siapa saja yang mencintai pengetahuan dan perjalanan.</p>
    <p>Selamat membaca, semoga kamu menemukan makna di setiap paragrafnya 🌿</p>
  </section>

  <footer>
    © 2025 Ruang Kata
Dibuat dengan hati, ditulis dengan rasa. Terima kasih telah membaca 🌸

</body>
</html>
