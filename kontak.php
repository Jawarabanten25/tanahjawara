<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Ikatan Pelajar Muhammadiyah Provinsi Banten</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Umum */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f9f9f9;
            max-width: 1200px;
            margin: 0 auto;
            overflow-x: hidden;
        }

        /* Header */
        header {
            background-color: #00793e;
            color: white;
            padding: 10px 20px;
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
nav a:hover, nav a:active {
    color: yellow;
}
nav a::after {
    display: none;
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
            }
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
            font-size: 14px;
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="ipmbanten.png" alt="Logo">
            <h1>IKATAN PELAJAR MUHAMMADIYAH PROVINSI BANTEN</h1>
        </div>
        <nav>
            <a href="home.php" class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">Beranda</a>
            <a href="pengurus.php" class="<?= basename($_SERVER['PHP_SELF']) == 'pengurus.php' ? 'active' : '' ?>">Pengurus</a>
            <a href="berita.php" class="<?= basename($_SERVER['PHP_SELF']) == 'berita.php' ? 'active' : '' ?>">Berita</a>
        </nav>
    </header>

    <main>
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
            <a href="https://twitter.com" target="_blank">
                <img src="instagram.png" alt="Instagram">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="whatsapp.png" alt="Whatsapp">
            </a>
            <a href="https://linkedin.com" target="_blank">
                <img src="youtube.png" alt="Youtube">
            </a>
        </div>

    </div>
    </main>

    <footer>
        <p>&copy; 2024 Ikatan Pelajar Muhammadiyah Provinsi Banten. All rights reserved.</p>
    </footer>
</body>
</html>
