<?php
session_start();
include 'config.php';

// Periksa apakah admin telah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: login_admin.php');
    exit();
}

// Check if 'id' and 'action' are set in the URL
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    // Prepare the DELETE SQL query
    $stmt = $pdo->prepare("DELETE FROM berita WHERE id = :id");

    // Execute the delete query
    $stmt->execute(['id' => $id]);

    // Check if any rows were affected (i.e., if the record was deleted)
    if ($stmt->rowCount() > 0) {
        // Successfully deleted the record, redirect to the admin dashboard
        header('Location: dashboard_admin.php?message=deleted');
    } else {
        // If no rows were deleted, redirect with a failure message
        header('Location: dashboard_admin.php?message=delete_failed');
    }
    exit();
}
?>
