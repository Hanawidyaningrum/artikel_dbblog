<?php
$host = "localhost";
$user = "root";
$pass = "Hanna0803#"; // Pastikan ini adalah password yang benar
$db = "artikel_dbblog"; // Pastikan ini adalah nama database yang benar

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

/**
 * Fungsi pembantu untuk menjalankan query SELECT sederhana dan mengembalikan baris.
 * Digunakan untuk fungsi-fungsi yang tidak memerlukan prepared statement yang kompleks.
 * @param string $query Query SQL.
 * @return array Array asosiatif dari hasil query.
 */
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    if (!$result) {
        // Log error ke file log server atau tampilkan untuk debugging (di lingkungan dev saja)
        error_log("Query error: " . mysqli_error($conn) . " Query: " . $query);
        return [];
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

/**
 * Memeriksa kredensial login pengguna.
 * @param string $email Email pengguna.
 * @param string $password Password yang dimasukkan pengguna.
 * @return array|false Mengembalikan array data pengguna (termasuk 'id', 'email', 'nickname') jika login berhasil, false jika gagal.
 */
function checkLogin($email, $password) {
    global $conn;

    // Gunakan prepared statement untuk mencegah SQL injection
    $query = "SELECT id, email, password, nickname FROM author WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        error_log("Login query preparation failed: " . mysqli_error($conn));
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Penting: Gunakan password_verify() jika password di database di-hash
        if (password_verify($password, $user['password'])) {
            mysqli_stmt_close($stmt);
            // Hapus password hash dari array sebelum dikembalikan, untuk keamanan tambahan
            unset($user['password']);
            return $user;
        }
    }
    mysqli_stmt_close($stmt);
    return false; // Login gagal
}


function searchArticles($keyword) {
    global $conn;
    $query = "SELECT a.*,
                    (SELECT GROUP_CONCAT(DISTINCT au.nickname SEPARATOR ', ') FROM author au JOIN article_author aa ON au.id = aa.author_id WHERE aa.article_id = a.id) AS authors_nickname,
                    (SELECT GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') FROM category c JOIN article_category ac ON c.id = ac.category_id WHERE ac.article_id = a.id) AS categories_name
              FROM article a
              WHERE a.title LIKE ? OR a.content LIKE ?
              ORDER BY a.date DESC";

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Query preparation failed in searchArticles: " . mysqli_error($conn));
        return [];
    }
    $likeKeyword = '%' . $keyword . '%';
    mysqli_stmt_bind_param($stmt, "ss", $likeKeyword, $likeKeyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $articles = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $articles;
}

function hariIndonesia($hariInggris) {
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    return $hari[$hariInggris] ?? $hariInggris;
}

function namaBulan($bulanAngka) {
    $bulan = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
        '04' => 'April', '05' => 'Mei', '06' => 'Juni',
        '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
        '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];
    return $bulan[str_pad($bulanAngka, 2, '0', STR_PAD_LEFT)] ?? $bulanAngka;
}

// --- COUNT FUNCTIONS ---

function getArticleCount() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM article");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Cast to int
    }
    return 0;
}

function getCategoryCount() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM category");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Cast to int
    }
    return 0;
}

function getAuthorCount() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM author");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Cast to int
    }
    return 0;
}

// --- ARTICLE FUNCTIONS ---

function getAllArticles() {
    global $conn;
    $query = "
        SELECT a.*,
            (SELECT GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ')
             FROM category c
             JOIN article_category ac ON c.id = ac.category_id
             WHERE ac.article_id = a.id) AS categories_name,
            (SELECT GROUP_CONCAT(DISTINCT au.nickname SEPARATOR ', ')
             FROM author au
             JOIN article_author aa ON au.id = aa.author_id
             WHERE aa.article_id = a.id) AS authors_nickname
        FROM article a
        ORDER BY a.date DESC
    ";
    $result = mysqli_query($conn, $query);
    $articles = [];
    if ($result) { // Pastikan query berhasil
        while ($row = mysqli_fetch_assoc($result)) {
            $articles[] = $row;
        }
    } else {
        error_log("Error in getAllArticles: " . mysqli_error($conn));
    }
    return $articles;
}

function getArticleById($id) {
    global $conn;

    // Fetch main article details
    $query_article = "
        SELECT a.*
        FROM article a
        WHERE a.id = ?
        LIMIT 1
    ";
    $stmt_article = mysqli_prepare($conn, $query_article);
    if (!$stmt_article) {
        error_log("Failed to prepare getArticleById (article) query: " . mysqli_error($conn));
        return null;
    }
    mysqli_stmt_bind_param($stmt_article, "i", $id);
    mysqli_stmt_execute($stmt_article);
    $result_article = mysqli_stmt_get_result($stmt_article);
    $article = mysqli_fetch_assoc($result_article);
    mysqli_stmt_close($stmt_article);

    if ($article) {
        // Fetch categories name AND IDs
        $kategoriQuery = "
            SELECT GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') AS categories_name,
                   GROUP_CONCAT(DISTINCT c.id SEPARATOR ',') AS category_ids
            FROM category c
            JOIN article_category ac ON c.id = ac.category_id
            WHERE ac.article_id = ?
        ";
        $stmt_kategori = mysqli_prepare($conn, $kategoriQuery);
        if (!$stmt_kategori) {
            error_log("Failed to prepare getArticleById (categories) query: " . mysqli_error($conn));
        } else {
            mysqli_stmt_bind_param($stmt_kategori, "i", $id);
            mysqli_stmt_execute($stmt_kategori);
            $kategoriResult = mysqli_stmt_get_result($stmt_kategori);
            $row_kategori = mysqli_fetch_assoc($kategoriResult);
            $article['categories_name'] = $row_kategori['categories_name'] ?? '';
            $article['category_ids'] = $row_kategori['category_ids'] ?? ''; // Store category IDs as string
            mysqli_stmt_close($stmt_kategori);
        }

        // Fetch authors nickname AND IDs
        $authorQuery = "
            SELECT GROUP_CONCAT(DISTINCT au.nickname SEPARATOR ', ') AS authors_nickname,
                   GROUP_CONCAT(DISTINCT au.id SEPARATOR ',') AS author_ids
            FROM author au
            JOIN article_author aa ON au.id = aa.author_id
            WHERE aa.article_id = ?
        ";
        $stmt_author = mysqli_prepare($conn, $authorQuery);
        if (!$stmt_author) {
            error_log("Failed to prepare getArticleById (authors) query: " . mysqli_error($conn));
        } else {
            mysqli_stmt_bind_param($stmt_author, "i", $id);
            mysqli_stmt_execute($stmt_author);
            $authorResult = mysqli_stmt_get_result($stmt_author);
            $row_author = mysqli_fetch_assoc($authorResult);
            $article['authors_nickname'] = $row_author['authors_nickname'] ?? '';
            $article['author_ids'] = $row_author['author_ids'] ?? ''; // Store author IDs as string
            mysqli_stmt_close($stmt_author);
        }
    }
    return $article;
}


// NEW: Function to get array of author IDs for a given article
function getArticleAuthorIds($articleId) {
    global $conn;
    $query = "SELECT author_id FROM article_author WHERE article_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Failed to prepare getArticleAuthorIds query: " . mysqli_error($conn));
        return [];
    }
    mysqli_stmt_bind_param($stmt, "i", $articleId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $authorIds = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $authorIds[] = (int)$row['author_id']; // Cast to int
    }
    mysqli_stmt_close($stmt);
    return $authorIds;
}

// NEW: Function to get array of category IDs for a given article
function getArticleCategoryIds($articleId) {
    global $conn;
    $query = "SELECT category_id FROM article_category WHERE article_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Failed to prepare getArticleCategoryIds query: " . mysqli_error($conn));
        return [];
    }
    mysqli_stmt_bind_param($stmt, "i", $articleId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $categoryIds = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $categoryIds[] = (int)$row['category_id']; // Cast to int
    }
    mysqli_stmt_close($stmt);
    return $categoryIds;
}


// MODIFIED: getRelatedArticles to use category IDs
function getRelatedArticles($currentArticleId, $categoryIds, $limit = 4) {
    global $conn;
    $relatedArticles = [];

    // Ensure categoryIds is a string, then convert to an array of integers
    if (empty($categoryIds)) {
        return $relatedArticles;
    }

    $categoryArray = array_map('intval', array_filter(explode(',', $categoryIds)));

    if (empty($categoryArray)) {
        return $relatedArticles;
    }

    $placeholders = implode(',', array_fill(0, count($categoryArray), '?'));
    $types = str_repeat('i', count($categoryArray));
    $params = $categoryArray; // Initial parameters are category IDs

    $query = "SELECT DISTINCT a.id, a.title
              FROM article a
              JOIN article_category ac ON a.id = ac.article_id
              WHERE ac.category_id IN ($placeholders)
                AND a.id != ?
              ORDER BY RAND() LIMIT ?"; // Use RAND() for better variety, or a fixed order like date DESC if preferred

    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Failed to prepare related articles query: " . mysqli_error($conn));
        return [];
    }

    // Add currentArticleId and limit to parameters
    $params[] = $currentArticleId;
    $params[] = $limit;
    $types .= 'ii'; // Add types for currentArticleId and limit

    // Dynamically bind parameters
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $relatedArticles[] = $row;
        }
    } else {
        error_log("Failed to get related articles result: " . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);
    return $relatedArticles;
}

/**
 * Mengunggah gambar ke direktori 'img/'.
 * @param array $file Array $_FILES dari input gambar.
 * @return string|false Nama file yang diunggah jika berhasil, false jika gagal.
 */
function uploadGambar($file) {
    // Pastikan ini sesuai dengan nama input file di form Anda (misalnya name="picture")
    // Fungsi addArticle dan updateArticle menggunakan $files['picture'], jadi ini disesuaikan.
    if (!isset($file['picture']) || $file['picture']['error'] !== UPLOAD_ERR_OK) {
        return false; // Tidak ada file diunggah atau ada error
    }

    $namaFileAsli = $file['picture']['name'];
    $tmpName = $file['picture']['tmp_name'];
    $ext = strtolower(pathinfo($namaFileAsli, PATHINFO_EXTENSION)); // Pastikan ekstensi huruf kecil
    
    // Periksa jenis file gambar
    $allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
    if (!in_array($ext, $allowedExtensions)) {
        echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG & GIF yang diperbolehkan.');</script>";
        return false;
    }

    // Periksa ukuran file (maksimal 5MB)
    if ($file['picture']['size'] > 5000000) { // 5MB
        echo "<script>alert('Maaf, ukuran gambar terlalu besar (maksimal 5MB).');</script>";
        return false;
    }

    $newName = uniqid('img_', true) . '.' . $ext; // Tambahkan prefix untuk keunikan dan mudah diidentifikasi
    $target = 'img/' . $newName;

    if (!is_dir(dirname($target))) {
        mkdir(dirname($target), 0755, true); // Buat direktori jika belum ada
    }

    if (move_uploaded_file($tmpName, $target)) {
        return $newName;
    }
    echo "<script>alert('Gagal memindahkan file yang diunggah.');</script>";
    return false;
}

/**
 * Menambahkan artikel baru ke database.
 * @param array $data Data artikel dari form.
 * @param array $files Data file gambar dari $_FILES.
 * @return bool True jika berhasil, false jika gagal.
 */
function addArticle($data, $files) {
    global $conn;
    $title      = htmlspecialchars($data['title']);
    $content    = $data['content']; // HTML content, hati-hati dengan XSS jika tidak disanitasi saat ditampilkan
    $date       = $data['date']; // Tanggal harus dalam format 'YYYY-MM-DD HH:MM:SS'
    $authorIds  = $data['author']; // Ini harus berupa array ID penulis
    $categoryIds = isset($data['category']) ? (array)$data['category'] : []; // Ini harus berupa array ID kategori

    $imageName = uploadGambar($files); // Gunakan fungsi uploadGambar yang sudah ada

    if ($imageName === false && ($files['picture']['error'] !== UPLOAD_ERR_NO_FILE)) {
        // Jika ada file yang diunggah tapi uploadGambar gagal
        // Pesan error sudah ditampilkan di dalam uploadGambar
        return false;
    }

    mysqli_begin_transaction($conn);
    try {
        // Insert article
        $stmt = $conn->prepare("INSERT INTO article (title, content, picture, date) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Gagal prepare statement artikel: {$conn->error}");
        }
        $stmt->bind_param("ssss", $title, $content, $imageName, $date);
        if (!$stmt->execute()) {
            throw new Exception("Gagal menyimpan artikel utama: {$stmt->error}");
        }
        $articleId = $conn->insert_id;
        $stmt->close();

        // Insert into article_author
        $stmtAuthor = $conn->prepare("INSERT INTO article_author (article_id, author_id) VALUES (?, ?)");
        if (!$stmtAuthor) {
            throw new Exception("Gagal prepare statement article_author: {$conn->error}");
        }
        foreach ($authorIds as $authorId) {
            $authorId = (int)$authorId; // Pastikan ini integer
            $stmtAuthor->bind_param("ii", $articleId, $authorId);
            if (!$stmtAuthor->execute()) {
                throw new Exception("Gagal menyimpan relasi penulis: {$stmtAuthor->error}");
            }
        }
        $stmtAuthor->close();

        // Insert into article_category
        $stmtCat = $conn->prepare("INSERT INTO article_category (article_id, category_id) VALUES (?, ?)");
        if (!$stmtCat) {
            throw new Exception("Gagal prepare statement article_category: {$conn->error}");
        }
        foreach ($categoryIds as $categoryId) {
            $categoryId = (int)$categoryId; // Pastikan ini integer
            $stmtCat->bind_param("ii", $articleId, $categoryId);
            if (!$stmtCat->execute()) {
                throw new Exception("Gagal menyimpan relasi kategori: {$stmtCat->error}");
            }
        }
        $stmtCat->close();

        mysqli_commit($conn);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        // Hapus gambar yang sudah terupload jika ada kegagalan di tengah transaksi
        $upload_dir = 'img/';
        if ($imageName && file_exists($upload_dir . $imageName)) {
            unlink($upload_dir . $imageName);
        }
        echo "<script>alert('Error menambah artikel: " . $e->getMessage() . "');</script>";
        return false;
    }
}


/**
 * Memperbarui artikel di database.
 * @param array $data Data artikel dari form.
 * @param array $files Data file gambar dari $_FILES.
 * @return bool True jika berhasil, false jika gagal.
 */
function updateArticle($data, $files) {
    global $conn;
    $id = $data['id'];
    $title = htmlspecialchars($data['title']);
    $content = $data['content'];
    $old_picture = $data['old_picture'];

    $new_category_ids = isset($data['category']) ? (array)$data['category'] : [];
    $new_author_ids = isset($data['author']) ? (array)$data['author'] : [];

    $picture_name = $old_picture;
    $upload_dir = 'img/';

    // Periksa apakah ada gambar baru yang diunggah
    if (isset($files['picture']) && $files['picture']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadedNewName = uploadGambar($files); // Gunakan fungsi uploadGambar

        if ($uploadedNewName === false) {
            // uploadGambar sudah menampilkan pesan alert jika ada masalah
            return false;
        } else {
            // Jika upload berhasil, hapus gambar lama jika ada
            if (!empty($old_picture) && file_exists($upload_dir . $old_picture)) {
                unlink($upload_dir . $old_picture);
            }
            $picture_name = $uploadedNewName;
        }
    }

    mysqli_begin_transaction($conn);
    try {
        // Update main article table
        $sql_update_article = "UPDATE article SET title = ?, content = ?, picture = ? WHERE id = ?";
        $stmt_article = mysqli_prepare($conn, $sql_update_article);
        if (!$stmt_article) {
            throw new Exception("Gagal prepare statement update artikel: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_article, "sssi", $title, $content, $picture_name, $id);
        if (!mysqli_stmt_execute($stmt_article)) {
            throw new Exception("Error mengupdate artikel: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_article);

        // --- Update Categories (many-to-many) ---
        // 1. Delete existing relationships for this article
        $stmt_delete_ac = mysqli_prepare($conn, "DELETE FROM article_category WHERE article_id = ?");
        if (!$stmt_delete_ac) {
            throw new Exception("Gagal prepare statement delete relasi kategori: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_delete_ac, "i", $id);
        if (!mysqli_stmt_execute($stmt_delete_ac)) {
            throw new Exception("Error menghapus relasi kategori lama: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_delete_ac);

        // 2. Insert new relationships
        if (!empty($new_category_ids)) {
            $sql_insert_ac = "INSERT INTO article_category (article_id, category_id) VALUES (?, ?)";
            $stmt_insert_ac = mysqli_prepare($conn, $sql_insert_ac);
            if (!$stmt_insert_ac) {
                throw new Exception("Gagal prepare statement insert relasi kategori: " . mysqli_error($conn));
            }
            foreach ($new_category_ids as $cat_id) {
                $cat_id = (int)$cat_id; // Ensure it's an integer
                mysqli_stmt_bind_param($stmt_insert_ac, "ii", $id, $cat_id);
                if (!mysqli_stmt_execute($stmt_insert_ac)) {
                    throw new Exception("Error menambahkan relasi kategori baru: " . mysqli_error($conn));
                }
            }
            mysqli_stmt_close($stmt_insert_ac);
        }

        // --- Update Authors (many-to-many) ---
        // 1. Delete existing relationships for this article
        $stmt_delete_aa = mysqli_prepare($conn, "DELETE FROM article_author WHERE article_id = ?");
        if (!$stmt_delete_aa) {
            throw new Exception("Gagal prepare statement delete relasi penulis: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_delete_aa, "i", $id);
        if (!mysqli_stmt_execute($stmt_delete_aa)) {
            throw new Exception("Error menghapus relasi penulis lama: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt_delete_aa);

        // 2. Insert new relationships
        if (!empty($new_author_ids)) {
            $sql_insert_aa = "INSERT INTO article_author (article_id, author_id) VALUES (?, ?)";
            $stmt_insert_aa = mysqli_prepare($conn, $sql_insert_aa);
            if (!$stmt_insert_aa) {
                throw new Exception("Gagal prepare statement insert relasi penulis: " . mysqli_error($conn));
            }
            foreach ($new_author_ids as $auth_id) {
                $auth_id = (int)$auth_id; // Ensure it's an integer
                mysqli_stmt_bind_param($stmt_insert_aa, "ii", $id, $auth_id);
                if (!mysqli_stmt_execute($stmt_insert_aa)) {
                    throw new Exception("Error menambahkan relasi penulis baru: " . mysqli_error($conn));
                }
            }
            mysqli_stmt_close($stmt_insert_aa);
        }

        mysqli_commit($conn);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Error mengupdate artikel: " . $e->getMessage() . "');</script>";
        return false;
    }
}

/**
 * Menghapus artikel dari database beserta relasi dan gambarnya.
 * @param int $id ID artikel yang akan dihapus.
 * @return bool True jika berhasil, false jika gagal.
 */
function deleteArticle($id) {
    global $conn;
    mysqli_begin_transaction($conn);
    try {
        // Ambil nama gambar artikel untuk dihapus dari server
        $article = getArticleById($id);
        if ($article && !empty($article['picture'])) {
            $upload_dir = 'img/';
            $file_to_delete = $upload_dir . $article['picture'];
            if (file_exists($file_to_delete)) {
                if (!unlink($file_to_delete)) {
                    // Log error tapi jangan hentikan transaksi jika penghapusan file gagal
                    error_log("Failed to delete old image file: " . $file_to_delete);
                }
            }
        }

        // Hapus relasi di article_category
        $stmt_delete_ac = mysqli_prepare($conn, "DELETE FROM article_category WHERE article_id = ?");
        if (!$stmt_delete_ac) {
            throw new Exception("Gagal prepare statement delete relasi kategori: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_delete_ac, "i", $id);
        if (!mysqli_stmt_execute($stmt_delete_ac)) {
            throw new Exception("Error menghapus relasi kategori artikel.");
        }
        mysqli_stmt_close($stmt_delete_ac);

        // Hapus relasi di article_author
        $stmt_delete_aa = mysqli_prepare($conn, "DELETE FROM article_author WHERE article_id = ?");
        if (!$stmt_delete_aa) {
            throw new Exception("Gagal prepare statement delete relasi penulis: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_delete_aa, "i", $id);
        if (!mysqli_stmt_execute($stmt_delete_aa)) {
            throw new Exception("Error menghapus relasi penulis artikel.");
        }
        mysqli_stmt_close($stmt_delete_aa);

        // Hapus artikel utama
        $sql_delete = "DELETE FROM article WHERE id = ?";
        $stmt_delete_article = mysqli_prepare($conn, $sql_delete);
        if (!$stmt_delete_article) {
            throw new Exception("Gagal prepare statement delete artikel: " . mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt_delete_article, "i", $id);
        if (!mysqli_stmt_execute($stmt_delete_article)) {
            throw new Exception("Error menghapus artikel dari database.");
        }
        mysqli_stmt_close($stmt_delete_article);

        mysqli_commit($conn);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "<script>alert('Error menghapus artikel: " . $e->getMessage() . "');</script>";
        return false;
    }
}

// --- CATEGORY FUNCTIONS ---

/**
 * Mengambil semua kategori dari database.
 * @return array Array asosiatif dari semua kategori.
 */
function getAllCategories() {
    global $conn;
    return query("SELECT id, name, description FROM category ORDER BY name ASC");
}

/**
 * Mengambil kategori berdasarkan ID.
 * @param int $id ID kategori.
 * @return array|null Array asosiatif kategori jika ditemukan, null jika tidak.
 */
function getCategoryById($id) {
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT id, name, description FROM category WHERE id = ?");
    if (!$stmt) {
        error_log("Failed to prepare getCategoryById query: " . mysqli_error($conn));
        return null;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $category = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $category;
}

/**
 * Menambahkan kategori baru ke database.
 * @param array $data Data kategori dari form.
 * @return bool True jika berhasil, false jika gagal.
 */
function addCategory($data) {
    global $conn;
    $name = htmlspecialchars($data['name']);
    $description = htmlspecialchars($data['description']);

    $sql_insert = "INSERT INTO category (name, description) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql_insert);
    if (!$stmt) {
        echo "<script>alert('Gagal prepare statement addCategory: {$conn->error}');</script>";
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ss", $name, $description);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        if (mysqli_errno($conn) == 1062) { // Error code for duplicate entry
            echo "<script>alert('Error: Nama kategori sudah ada.');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
        mysqli_stmt_close($stmt);
        return false;
    }
}

/**
 * Memperbarui kategori di database.
 * @param array $data Data kategori dari form.
 * @return bool True jika berhasil, false jika gagal.
 */
function updateCategory($data) {
    global $conn;
    $id = $data['id'];
    $name = htmlspecialchars($data['name']);
    $description = htmlspecialchars($data['description']);

    $sql_update = "UPDATE category SET name = ?, description = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_update);
    if (!$stmt) {
        echo "<script>alert('Gagal prepare statement updateCategory: {$conn->error}');</script>";
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ssi", $name, $description, $id);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        if (mysqli_errno($conn) == 1062) { // Error code for duplicate entry
            echo "<script>alert('Error: Nama kategori sudah terdaftar.');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
        mysqli_stmt_close($stmt);
        return false;
    }
}

/**
 * Menghapus kategori dari database.
 * Akan gagal jika kategori masih digunakan oleh artikel.
 * @param int $id ID kategori yang akan dihapus.
 * @return string|bool True jika berhasil, string pesan error jika gagal.
 */
function deleteCategory($id) {
    global $conn;
    // Check if category is still used by any article
    $check_sql = "SELECT COUNT(*) FROM article_category WHERE category_id = ?";
    $stmt_check = mysqli_prepare($conn, $check_sql);
    if (!$stmt_check) {
        return "Gagal prepare statement checkCategoryUsage: " . mysqli_error($conn);
    }
    mysqli_stmt_bind_param($stmt_check, "i", $id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $article_count);
    mysqli_stmt_fetch($stmt_check);
    mysqli_stmt_close($stmt_check);

    if ($article_count > 0) {
        return "Gagal menghapus kategori. Kategori ini masih digunakan oleh " . $article_count . " artikel.";
    }

    // If not used, proceed to delete
    $sql_delete = "DELETE FROM category WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_delete);
    if (!$stmt) {
        return "Gagal prepare statement deleteCategory: " . mysqli_error($conn);
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        return "Error menghapus kategori: " . mysqli_error($conn);
    }
}

// --- AUTHOR FUNCTIONS ---

/**
 * Mengambil semua penulis dari database.
 * Tidak mengambil kolom password untuk keamanan.
 * @return array Array asosiatif dari semua penulis.
 */
function getAllAuthors() {
    global $conn;
    // HANYA SELECT kolom yang diperlukan, JANGAN sertakan 'password' untuk tampilan daftar
    return query("SELECT id, nickname, email FROM author ORDER BY nickname ASC");
}

/**
 * Mengambil penulis berdasarkan ID.
 * Tidak mengambil kolom password untuk keamanan.
 * @param int $id ID penulis.
 * @return array|null Array asosiatif penulis jika ditemukan, null jika tidak.
 */
function getAuthorById($id) {
    global $conn;
    // HANYA SELECT kolom yang diperlukan, JANGAN sertakan 'password'
    $stmt = mysqli_prepare($conn, "SELECT id, nickname, email FROM author WHERE id = ?");
    if (!$stmt) {
        error_log("Failed to prepare getAuthorById query: " . mysqli_error($conn));
        return null;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $author = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $author;
}

/**
 * Menambahkan penulis baru ke database.
 * Password akan di-hash sebelum disimpan.
 * @param array $data Data penulis dari form.
 * @return bool True jika berhasil, false jika gagal.
 */
function addAuthor($data) {
    global $conn;
    $nickname = htmlspecialchars($data['nickname']);
    $email = htmlspecialchars($data['email']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Hash password for security

    $sql_insert = "INSERT INTO author (nickname, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_insert);
    if (!$stmt) {
        echo "<script>alert('Gagal prepare statement addAuthor: {$conn->error}');</script>";
        return false;
    }
    mysqli_stmt_bind_param($stmt, "sss", $nickname, $email, $password);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        if (mysqli_errno($conn) == 1062) { // Error code for duplicate entry
            echo "<script>alert('Error: Email sudah terdaftar.');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
        mysqli_stmt_close($stmt);
        return false;
    }
}

/**
 * Memperbarui data penulis di database.
 * Password akan di-hash jika ada password baru yang diberikan.
 * @param array $data Data penulis dari form.
 * @return bool True jika berhasil, false jika gagal.
 */
function updateAuthor($data) {
    global $conn;
    $id = $data['id'];
    $nickname = htmlspecialchars($data['nickname']);
    $email = htmlspecialchars($data['email']);

    // Hanya update password jika ada password baru yang diisi
    if (isset($data['password']) && !empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql_update = "UPDATE author SET nickname = ?, email = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql_update);
        if (!$stmt) {
            echo "<script>alert('Gagal prepare statement updateAuthor with password: {$conn->error}');</script>";
            return false;
        }
        mysqli_stmt_bind_param($stmt, "sssi", $nickname, $email, $password, $id);
    } else {
        $sql_update = "UPDATE author SET nickname = ?, email = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql_update);
        if (!$stmt) {
            echo "<script>alert('Gagal prepare statement updateAuthor: {$conn->error}');</script>";
            return false;
        }
        mysqli_stmt_bind_param($stmt, "ssi", $nickname, $email, $id);
    }
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        if (mysqli_errno($conn) == 1062) { // Error code for duplicate entry
            echo "<script>alert('Error: Email sudah terdaftar.');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
        mysqli_stmt_close($stmt);
        return false;
    }
}

/**
 * Menghapus penulis dari database.
 * Akan gagal jika penulis masih terkait dengan artikel.
 * @param int $id ID penulis yang akan dihapus.
 * @return bool True jika berhasil, false jika gagal.
 */
function deleteAuthor($id) {
    global $conn;
    // Check if author is still associated with any article
    $check_sql = "SELECT COUNT(*) FROM article_author WHERE author_id = ?";
    $stmt_check = mysqli_prepare($conn, $check_sql);
    if (!$stmt_check) {
        echo "<script>alert('Gagal prepare statement checkAuthorUsage: " . mysqli_error($conn) . "');</script>";
        return false;
    }
    mysqli_stmt_bind_param($stmt_check, "i", $id);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $article_count);
    mysqli_stmt_fetch($stmt_check);
    mysqli_stmt_close($stmt_check);

    if ($article_count > 0) {
        echo "<script>alert('Gagal menghapus penulis. Penulis ini masih memiliki " . $article_count . " artikel.');</script>";
        return false;
    }

    // If not associated with any article, proceed to delete
    $sql_delete = "DELETE FROM author WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_delete);
    if (!$stmt) {
        echo "<script>alert('Gagal prepare statement deleteAuthor: " . mysqli_error($conn) . "');</script>";
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        echo "<script>alert('Error menghapus penulis: " . mysqli_error($conn) . "');</script>";
        mysqli_stmt_close($stmt);
        return false;
    }
}

?>