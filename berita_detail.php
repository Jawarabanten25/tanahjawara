<?php
include 'config.php';

// Periksa apakah ID berita ada di parameter URL
if (!isset($_GET['id'])) {
    echo "ID berita tidak ditemukan.";
    exit();
}

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mendapatkan detail berita berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM berita WHERE id = :id");
$stmt->execute(['id' => $id]);
$news = $stmt->fetch();

// Periksa apakah berita ditemukan
if (!$news) {
    echo "Berita tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Berita</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        h1 {
            color: #00793e;
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .meta {
            font-size: 14px;
            color: #999;
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #00793e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #005f2c;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Gambar Berita">
        <h1><?php echo htmlspecialchars($news['title']); ?></h1>
        <div class="meta">Diposting pada: <?php echo $news['created_at']; ?></div>
        <p><?php echo nl2br(htmlspecialchars($news['description'])); ?></p>
        <a href="home.php" class="back-button">Kembali ke Berita</a>
    </div>
</body>
</html>
