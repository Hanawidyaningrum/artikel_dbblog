<?php
require '../admin/functions.php';
date_default_timezone_set('Asia/Jakarta');

$articleDetail = null;
$articles = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $articleDetail = getArticleById($id);
} elseif (isset($_GET['q'])) {
    $keyword = $_GET['q'];
    $articles = searchArticles($keyword);
} elseif (isset($_GET['k'])) {
    $kategori = $_GET['k'];
    $articles = query("
        SELECT a.*,
            (SELECT GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') FROM category c
             JOIN article_category ac ON c.id = ac.category_id WHERE ac.article_id = a.id) AS categories_name,
            (SELECT GROUP_CONCAT(DISTINCT au.nickname SEPARATOR ', ') FROM author au
             JOIN article_author aa ON au.id = aa.author_id WHERE aa.article_id = a.id) AS authors_nickname
        FROM article a
        JOIN article_category ac ON a.id = ac.article_id
        JOIN category c ON ac.category_id = c.id
        WHERE c.name = '" . mysqli_real_escape_string($conn, $kategori) . "'
        ORDER BY a.date DESC
    ");
} else {
    $articles = getAllArticles();
}

function getFirstSentence($text) {
    $cleanText = strip_tags($text);
    $cleanText = str_replace(["\r", "\n"], ' ', $cleanText);
    $cleanText = preg_replace('/\s+/', ' ', $cleanText);
    $sentenceEndings = ['.', '?', '!'];
    $firstSentenceEnd = -1;

    foreach ($sentenceEndings as $ending) {
        $pos = strpos($cleanText, $ending);
        if ($pos !== false && ($firstSentenceEnd === -1 || $pos < $firstSentenceEnd)) {
            $firstSentenceEnd = $pos;
        }
    }

    return $firstSentenceEnd !== -1 ? trim(substr($cleanText, 0, $firstSentenceEnd + 1)) : trim($cleanText);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ruang Kata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .related-card {
            background-color: #f1f1f1;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .related-card a {
            text-decoration: none;
            color: #333;
        }
        .related-card a:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>
<header class="site-header">
    <div class="navbar">
        <div><strong>Ruang Kata</strong></div>
        <nav>
            <a href="artikel_pengunjung.php">Beranda</a>
            <a href="tentang.php">Tentang</a>
            <a href="kontak.php">Kontak</a>
        </nav>
    </div>
</header>

<section class="hero-text">
    <h2 class="hero-title">Selamat Datang di Ruang Kata</h2>
    <p class="hero-subtitle">Menelusuri inspirasi dari wisata, budaya, teknologi, dan pendidikan di balik setiap paragraf.</p>
</section>

<div class="container">
    <div class="main-content">
        <?php if ($articleDetail): ?>
            <div class="konten-artikel">
                <div class="card-with-image">
                    <?php if (!empty($articleDetail['picture'])): ?>
                        <img src="../admin/img/<?= htmlspecialchars($articleDetail['picture']) ?>" alt="<?= htmlspecialchars($articleDetail['title']) ?>">
                    <?php endif; ?>
                    <div class="card-text">
                        <div class="article-meta">
                            <span>
                                <?= hariIndonesia(date("l", strtotime($articleDetail['date']))) ?>,
                                <?= date("d", strtotime($articleDetail['date'])) ?>
                                <?= namaBulan(date("m", strtotime($articleDetail['date']))) ?>
                                <?= date("Y", strtotime($articleDetail['date'])) ?> |
                                <?= date("H:i", strtotime($articleDetail['date'])) ?> WIB
                                <?php if (!empty($articleDetail['authors_nickname'])): ?>
                                    | <?= htmlspecialchars($articleDetail['authors_nickname']) ?>
                                <?php endif; ?>
                                <?php if (!empty($articleDetail['categories_name'])): ?>
                                    | <?= htmlspecialchars($articleDetail['categories_name']) ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        <h2><?= htmlspecialchars($articleDetail['title']) ?></h2>
                        <div><?= $articleDetail['content'] ?></div>
                        <br>
                        <a href="artikel_pengunjung.php" class="btn-small">Kembali</a>
                    </div>
                </div>
            </div>
        <?php elseif (!empty($articles)): ?>
            <?php $featured = array_shift($articles); ?>
            <div class="featured-article">
                <?php if (!empty($featured['picture'])): ?>
                    <img src="../admin/img/<?= htmlspecialchars($featured['picture']) ?>" alt="<?= htmlspecialchars($featured['title']) ?>">
                <?php endif; ?>
                <div class="featured-text">
                    <div class="article-meta">
                        <span>
                            <?= hariIndonesia(date("l", strtotime($featured['date']))) ?>,
                            <?= date("d", strtotime($featured['date'])) ?>
                            <?= namaBulan(date("m", strtotime($featured['date']))) ?>
                            <?= date("Y", strtotime($featured['date'])) ?> |
                            <?= date("H:i", strtotime($featured['date'])) ?> WIB |
                            <?= htmlspecialchars($featured['authors_nickname'] ?? '-') ?> |
                            <?= htmlspecialchars($featured['categories_name'] ?? '-') ?>
                        </span>
                    </div>
                    <h2><?= htmlspecialchars($featured['title']) ?></h2>
                    <p><?= getFirstSentence($featured['content']) ?></p>
                    <a class="btn" href="artikel_pengunjung.php?id=<?= htmlspecialchars($featured['id']) ?>">Selengkapnya</a>
                </div>
            </div>

            <div class="grid-articles">
                <?php foreach ($articles as $article): ?>
                    <div class="small-article">
                        <?php if (!empty($article['picture'])): ?>
                            <img src="../admin/img/<?= htmlspecialchars($article['picture']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
                        <?php endif; ?>
                        <div class="text">
                            <div class="article-meta">
                                <span>
                                    <?= hariIndonesia(date("l", strtotime($article['date']))) ?>,
                                    <?= date("d", strtotime($article['date'])) ?>
                                    <?= namaBulan(date("m", strtotime($article['date']))) ?>
                                    <?= date("Y", strtotime($article['date'])) ?> |
                                    <?= date("H:i", strtotime($article['date'])) ?> WIB |
                                    <?= htmlspecialchars($article['authors_nickname'] ?? '-') ?> |
                                    <?= htmlspecialchars($article['categories_name'] ?? '-') ?>
                                </span>
                            </div>
                            <h3><?= htmlspecialchars($article['title']) ?></h3>
                            <p><?= getFirstSentence($article['content']) ?></p>
                            <a class="btn-small" href="artikel_pengunjung.php?id=<?= htmlspecialchars($article['id']) ?>">Selengkapnya</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Belum ada artikel yang tersedia.</p>
        <?php endif; ?>
    </div>

    <div class="sidebar">
        <div class="search-box card p-3">
            <h4 class="sidebar-title">Pencarian</h4>
            <form method="get" action="artikel_pengunjung.php">
                <input type="text" name="q" placeholder="Masukkan kata kunci..." />
                <button type="submit">Cari Artikel</button>
            </form>
        </div>

        <?php if ($articleDetail): ?>
            <?php
            $related = [];
            if (!empty($articleDetail['category_ids'])) {
                $related = getRelatedArticles($articleDetail['id'], $articleDetail['category_ids']);
            }
            ?>
            <div class="card p-3 mt-3">
                <h4 class="sidebar-title">Artikel Terkait</h4>
                <?php if (count($related) > 0): ?>
                    <div class="related-cards">
                        <?php foreach ($related as $rel): ?>
                            <div class="related-card">
                                <a href="artikel_pengunjung.php?id=<?= htmlspecialchars($rel['id']) ?>">
                                    <?= htmlspecialchars($rel['title']) ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Tidak ada artikel terkait.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="kategori-box card p-3 mt-3">
                <h4 class="sidebar-title">Kategori</h4>
                <ul>
                    <li><a href="artikel_pengunjung.php?k=Wisata">Wisata</a></li>
                    <li><a href="artikel_pengunjung.php?k=Budaya">Budaya</a></li>
                    <li><a href="artikel_pengunjung.php?k=Teknologi & Inovasi">Teknologi & Inovasi</a></li>
                    <li><a href="artikel_pengunjung.php?k=Pendidikan">Pendidikan</a></li>
                </ul>
            </div>

            <div class="tentang-box card p-3 mt-3">
                <h4 class="sidebar-title">Tentang</h4>
                <p>Catatan perjalanan menyusuri tempat wisata, budaya lokal, inovasi teknologi, dan cerita pendidikan di berbagai sudut Indonesia.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; 2025 Ruang Kata</p>
    <p>Dibuat dengan hati, ditulis dengan rasa. Terima kasih telah membaca 🌸</p>
</footer>
</body>
</html>