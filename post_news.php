<?php
session_start();
include 'config.php';

// Periksa apakah admin telah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah input 'title' dan 'description' ada dalam POST
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';

    // Direktori tempat file akan disimpan
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;

    // Buat direktori jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Validasi file upload
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $error = "File yang diunggah bukan gambar.";
        $uploadOk = 0;
    }

    // Batasi jenis file yang diizinkan
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        $error = "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Cegah overwrite file
    if (file_exists($target_file)) {
        $error = "File dengan nama yang sama sudah ada.";
        $uploadOk = 0;
    }

    // Batasi ukuran file (contoh: maksimum 2MB)
    if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
        $error = "Ukuran file terlalu besar. Maksimum 2MB.";
        $uploadOk = 0;
    }

    // Proses upload jika validasi berhasil
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Simpan data ke database
            $stmt = $pdo->prepare("INSERT INTO berita (title, image, description) VALUES (?, ?, ?)");
            $stmt->execute([$title, $target_file, $description]);
            $success = "Berita berhasil diposting.";
            
            // Arahkan ke halaman berita.php setelah berhasil posting
            header('Location: berita.php');
            exit();
        } else {
            $error = "Terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST BERITA-BANTEN</title>
    <style>
       /* Background Gambar */
body {
    font-family: 'Arial', sans-serif;
    background-image: url('ipmbanten.png');
    background-size: cover; /* Membuat gambar menutupi seluruh layar */
    background-position: center center; /* Menempatkan gambar di tengah */
    background-attachment: fixed; /* Gambar tetap saat scroll */
    background-repeat: no-repeat; /* Mencegah pengulangan gambar */
    color: white;
    margin: 0;
    padding: 0;
    height: 100vh; /* Membuat tinggi halaman penuh */
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background-color: rgba(0, 0, 0, 0.7); /* Transparansi hitam untuk konten */
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
    width: 100%;
    max-width: 600px;
}

/* Flexbox untuk logo dan judul */
.header {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.header img {
    max-width: 50px; /* Ukuran logo lebih kecil */
    margin-right: 10px; /* Spasi antara logo dan judul */
}

h1 {
    font-size: 32px;
    margin: 0;
}

label {
    font-size: 16px;
    margin-bottom: 10px;
    display: block;
}

input[type="text"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

textarea {
    resize: vertical;
    height: 150px;
}

button {
    background-color: #00793e;
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
}

button:hover {
    background-color: #005f2c;
}

.success,
.error {
    text-align: center;
    font-size: 16px;
    margin-top: 20px;
}

.success {
    color: green;
}

.error {
    color: red;
}

/* Gambar responsif */
img {
    width: 100%;
    height: auto;
    object-fit: cover; /* Memastikan gambar tetap proporsional */
}

.return-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
}

.return-link a {
    color: #f4f4f4;
    font-weight: bold;
    text-decoration: none;
}

.return-link a:hover {
    color: #00793e;
}

    </style>
</head>
<body>

    <div class="container">
        <!-- Logo di samping judul -->
        <div class="header">
            <img src="ipmbanten.png" alt="IPM Banten Logo">
            <h1>POST BERITA MU😁😁😁</h1>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Judul Berita:</label>
            <input type="text" id="title" name="title" placeholder="Judul Berita" required><br><br>
            
            <label for="image">Pilih Gambar:</label>
            <input type="file" id="image" name="image" required><br><br>
            
            <label for="description">Deskripsi:</label>
            <textarea id="description" name="description" placeholder="Deskripsi" required></textarea><br><br>
            
            <button type="submit">Posting Berita</button>
        </form>

        <?php
        if (isset($success)) echo "<p class='success'>$success</p>";
        if (isset($error)) echo "<p class='error'>$error</p>";
        ?>

        <!-- Link untuk kembali -->
        <div class="return-link">
            <a href="dashboard_admin.php">Kembali</a>
        </div>
    </div>

</body>
</html>
