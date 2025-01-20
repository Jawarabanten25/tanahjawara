<?php
session_start();
require 'config.php'; // File koneksi database

$stmt = $pdo->query("SELECT * FROM berita ORDER BY created_at DESC LIMIT 3");
$news_items = $stmt->fetchAll();
// Contoh data statistik
$stat1 = 8;  // Contoh jumlah Pimpinan Daerah
$stat2 = 17; // Contoh jumlah Pimpinan Cabang
$stat3 = 86; // Contoh jumlah Pimpinan Ranting
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKATAN PELAJAR MUHAMMADIYAH PROVINSI BANTEN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f7fa;
            max-width: 1200px;
            margin: 0 auto;
            overflow-x: hidden;
            padding-bottom: 40px; /* Adds bottom padding for footer */
        }

        header {
            background-color: #00793e;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
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
nav a:hover, nav a:active {
    color: yellow;
}
nav a::after {
    display: none;
}

        /* Slider */
        .slider {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            height: 500px;
            margin-top: 20px;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 500%;
        }

        .slides img {
            width: 20%;
            height: 500px;
            object-fit: cover;
        }

        .navigation button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 20px;
        }

        .navigation button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Main Content */
        main {
            padding: 40px 20px;
            background-color: white;
            margin-top: 40px;
            border-radius: 8px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            font-size: 14px;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: space-between;
        }

        .article {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .article:hover {
            transform: scale(1.05);
        }

        .article img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .article h3 {
            font-size: 18px;
            color: #333;
            margin: 0;
            text-align: center;
            font-weight: bold;
        }

        .statistics {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            padding: 50px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            flex-direction: column;
            text-align: center;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        .statistics p {
            font-size: 24px;
            color: #00793e;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .stats-container {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .stat {
            text-align: center;
            margin: 15px;
        }

        .stat h3 {
            font-size: 18px;
            color: #00793e;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .stat span {
            font-size: 50px;
            font-weight: bold;
            color: #000;
        }

        .button-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    width: 100%; /* Pastikan kontainer mengisi seluruh lebar */
    text-align: center; /* Mengatur teks di dalam kontainer menjadi rata tengah */
}


.submit-link {
    padding: 15px 40px;
    background-color: #00793e;
    color: white;
    text-decoration: none;
    font-size: 18px;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.submit-link:hover {
    background-color: #005f2c;
    transform: translateY(-5px);
}

.submit-link:active {
    background-color: #004f1a;
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
                padding: 20px;
            }

            nav {
                margin-top: 20px;
            }

            .slider {
                height: 350px;
            }

            .statistics {
                padding: 30px;
            }

            .stats-container {
                flex-direction: column;
                align-items: center;
            }

            .stat {
                margin-bottom: 20px;
            }

            .content {
                flex-direction: column;
                align-items: center;
            }

            .article {
                width: 100%;
                max-width: 90%;
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
            <a href="pengurus.php">Pengurus</a>
            <a href="berita.php">Berita</a>
            <a href="kontak.php">Kontak</a>
        </nav>
    </header>

    <!-- Slider -->
    <div class="slider">
        <div class="slides">
            <img src="youtube.png" alt="Slide 1">
            <img src="whatsapp.png" alt="Slide 2">
            <img src="youtube.png" alt="Slide 3">
            <img src="whatsapp.png" alt="Slide 4">
            <img src="gambar.jpg" alt="Slide 5">
        </div>
        <div class="navigation">
            <button id="prev">&#10094;</button>
            <button id="next">&#10095;</button>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        <!-- Bagian Berita -->
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
            <div class="button-container">
                <a href="berita.php" class="submit-link">Baca Selengkapnya</a>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="statistics">
            <p>Pelajar Visioner dalam</p>
            <div class="stats-container">
                <div class="stat">
                    <span id="stat1"><?= $stat1 ?></span>
                    <h3>Pimpinan Daerah</h3>
                </div>
                <div class="stat">
                    <span id="stat2"><?= $stat2 ?></span>
                    <h3>Pimpinan Cabang</h3>
                </div>
                <div class="stat">
                    <span id="stat3"><?= $stat3 ?></span>
                    <h3>Pimpinan Ranting</h3>
                </div>
            </div>
        </section>
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
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Ikatan Pelajar Muhammadiyah Provinsi Banten. All rights reserved.</p>
    </footer>

    <script>
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        const slides = document.querySelector('.slides');
        const totalSlides = slides.children.length;
        let index = 0;

        function showSlide() {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            slides.style.transform = `translateX(-${index * 20}%)`;
        }

        prevButton.addEventListener('click', () => {
            index--;
            showSlide();
        });

        nextButton.addEventListener('click', () => {
            index++;
            showSlide();
        });

        setInterval(() => {
            index++;
            showSlide();
        }, 3000);
    </script>
</body>
</html>
