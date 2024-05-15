<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require_once './php_db/db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleteQuery = "DELETE FROM product_review WHERE id = ?";
    $stmt = $connect->prepare($deleteQuery);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = 'Review deleted successfully.';
    } else {
        $_SESSION['error'] = 'Error deleting review.';
    }
    $stmt->close();
    header('Location: product_dashboard.php');
    exit;
}
