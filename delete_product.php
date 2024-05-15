<?php
session_start();
require_once './php_db/db_connect.php'; 

if (!isset($_SESSION["adm"])) {
    header("Location: login.php"); 
    exit;
}

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id <= 0) {
    header("Location: dashboard.php");
    exit;
}

// Prepare statement to fetch product data
$stmt = $connect->prepare("SELECT * FROM product WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$productData = $result->fetch_assoc();

if (!$productData) {
    echo "Product not found.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare statement to delete product
    $deleteStmt = $conn->prepare("DELETE FROM product WHERE id = ?");
    $deleteStmt->bind_param("i", $product_id);
    $deleteStmt->execute();
    
    if ($deleteStmt->affected_rows > 0) {
        header("Location: dashboard.php"); // Redirect to the dashboard or a confirmation page
        exit;
    } else {
        echo "Error deleting product: " . $connect->error;
    }
    $deleteStmt->close();
}
$connect->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Delete Product</h2>
        <p>Are you sure you want to delete the following product?</p>
        <p><strong>Name:</strong> <?= htmlspecialchars($productData['name']) ?></p>
        <p><strong>Description:</strong> <?= htmlspecialchars($productData['description']) ?></p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a> 
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
