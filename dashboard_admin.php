<?php
session_start();
include 'config.php';

// Periksa apakah admin telah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

// Delete News
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    // Delete the news article from the database
    $stmt = $pdo->prepare("DELETE FROM berita WHERE id = :id");
    $stmt->execute(['id' => $id]);

    // Redirect to a new page after deletion
    header('Location: deleted_page.php');
    exit();
}

// Fetch all news articles (including archived ones)
$stmt = $pdo->query("SELECT * FROM berita ORDER BY created_at DESC");
$news_items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('ipmbanten.png');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            max-width: 1200px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            color: #00793e;
            margin-bottom: 20px;
        }

        a.action-button {
            padding: 12px 24px;
            background-color: #00793e;
            color: white;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s ease-in-out;
        }

        a.action-button:hover {
            background-color: #005f2c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 18px;
        }

        th {
            background-color: #00793e;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f9f9f9;
            color: #333;
        }

        .action-button.delete {
            background-color: #dc3545;
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
        }

        .action-button.delete:hover {
            background-color: #c82333;
        }

        .logout-button {
            display: block;
            margin: 30px auto 0 auto;
            padding: 12px 24px;
            background-color: #d9534f;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .logout-button:hover {
            background-color: #c9302c;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 30px;
            }

            table, th, td {
                font-size: 16px;
            }

            .action-button {
                padding: 10px 20px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 24px;
            }

            table, th, td {
                font-size: 14px;
            }

            .action-button {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Dashboard Admin</h1>
        <a href="post_news.php" class="action-button">Post New News</a>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news_items as $news): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($news['title']); ?></td>
                        <td><?php echo $news['created_at']; ?></td>
                        <td>
                            <?php echo $news['is_active'] == 1 ? 'Active' : 'Archived'; ?>
                        </td>
                        <td>
                            <?php if ($news['is_active'] == 1): ?>
                                <a href="dashboard_admin.php?id=<?php echo $news['id']; ?>&action=archive" class="action-button">Archive</a>
                            <?php else: ?>
                                <a href="post_news.php?id=<?php echo $news['id']; ?>&action=restore" class="action-button">Restore</a>
                            <?php endif; ?>
                            <a href="dashboard_admin.php?id=<?php echo $news['id']; ?>&action=delete" class="action-button delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Logout Button -->
        <a href="logout.php" class="logout-button">Logout</a>
    </div>

</body>
</html>
