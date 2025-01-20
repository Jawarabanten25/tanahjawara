<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    header('Location: login_admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('ipmbanten.png') no-repeat center center fixed;
            background-size: cover;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.9); /* Transparansi */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h1 {
            color: #00793e;
            font-size: 24px;
            margin-bottom: 1rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        input:focus {
            border-color: #00793e;
            outline: none;
            box-shadow: 0 0 3px rgba(0, 121, 62, 0.5);
        }
        button {
            padding: 0.8rem;
            background: #00793e;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #005a2e;
        }
        .login-link {
            margin-top: 1rem;
            font-size: 14px;
            color: #00793e;
        }
        .login-link a {
            color: #00793e;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register Admin</h1>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Sudah punya akun? <a href="login_admin.php">Silahkan Login</a>
        </div>
    </div>
</body>
</html>
