<?php
include 'config.php';

// Query untuk mengambil 12 berita terbaru
$stmt = $pdo->query("SELECT * FROM berita ORDER BY created_at DESC LIMIT 20");
$news_items = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Berita</title>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f6f8;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    header {
        background-color: #00793e;
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    header .logo {
        display: flex;
        align-items: center;
    }

    header .logo img {
        height: 40px;
        margin-right: 10px;
    }

    header .logo h1 {
        font-size: 20px;
        margin: 0;
    }

    nav a {
        color: white;
        text-decoration: none;
        margin: 0 15px;
        font-size: 14px;
        position: relative;
        transition: color 0.3s ease;
    }

    nav a:hover {
        color: yellow;
    }

    main {
        padding: 30px;
        background-color: white;
        margin-top: 30px;
    }

    footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 40px;
        font-size: 14px;
    }

    .article-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .article {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .article:hover {
        transform: translateY(-10px);
    }

    .article img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .article .content {
        padding: 20px;
    }

    .article h2 {
        font-size: 20px;
        color: #00793e;
        margin-bottom: 10px;
    }

    .article p {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .article .meta {
        font-size: 14px;
        color: #999;
    }

    .article .read-more {
        color: #00793e;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .article .read-more:hover {
        color: yellow;
    }
    .contact-section {
            background-color: #ffffff;
            padding: 40px 20px;
            margin-top: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .contact-section h2 {
            text-align: center;
            color: #00793e;
            margin-bottom: 20px;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 40px;
        }

        .contact-info div {
            text-align: center;
        }

        .contact-info div h3 {
            font-size: 18px;
            color: #00793e;
            margin-bottom: 10px;
        }

        .contact-info div a {
            display: block;
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;
            text-decoration: none;
        }

        .contact-info div a:hover {
            color: #00793e;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .social-icons a {
            display: inline-block;
        }

        .social-icons img {
            width: 40px;
            height: 40px;
            transition: transform 0.3s ease;
        }

        .social-icons img:hover {
            transform: scale(1.1);
        }


    @media (max-width: 768px) {
        header {
            flex-direction: column;
            padding: 10px;
        }

        nav {
            margin-top: 15px;
        }

        .article h2 {
            font-size: 18px;
        }
    }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="ipmbanten.png" alt="Logo">
            <h1>IKATAN PELAJAR MUHAMMADIYAH PROVINSI BANTEN</h1>
        </div>
        <nav>
            <a href="home.php">Beranda</a>
            <a href="pengurus.php" class="active">Pengurus</a>
            <a href="kontak.php">Kontak</a>
            <a href="login_admin.php">Login</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h1>Berita Terkini</h1>
        <div class="article-container">
            <?php if (count($news_items) > 0): ?>
                <?php foreach ($news_items as $news): ?>
                    <div class="article">
                        <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Gambar Berita">
                        <div class="content">
                            <h2><?php echo htmlspecialchars($news['title']); ?></h2>
                            <p><?php echo htmlspecialchars(substr($news['description'], 0, 150)); ?>...</p>
                            <div class="meta">Diposting pada: <?php echo $news['created_at']; ?></div>
                            <a href="berita_detail.php?id=<?php echo $news['id']; ?>" class="read-more">Baca Selengkapnya</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada berita saat ini.</p>
            <?php endif; ?>
        </div>
    </main>
     <!-- Contact Section -->
     <div class="contact-section">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <div>
                <h3>Email</h3>
                <a href="mailto:info@ipmbanten.org">info@ipmbanten.org</a>
            </div>
            <div>
                <h3>Phone</h3>
                <a href="tel:+62215555555">+62 21 555 5555</a>
            </div>
        </div>

        <!-- Social Media Icons -->
        <div class="social-icons">
            <a href="https://facebook.com" target="_blank">
                <img src="facebook.png" alt="Facebook">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="instagram.png" alt="Instagram">
            </a>
            <a href="https://whatsapp.com" target="_blank">
                <img src="whatsapp.png" alt="Whatsapp">
            </a>
            <a href="https://linkedin.com" target="_blank">
                <img src="youtube.png" alt="Youtube">
            </a>
        </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ikatan Pelajar Muhammadiyah Provinsi Banten. All rights reserved.</p>
    </footer>
</body>
</html>
