<?php
require_once './php_db/db_connect.php'; 


$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id <= 0) {
    echo "Invalid Product ID";
    exit;
}

// Fetch the product details
$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2><?= htmlspecialchars($product['name']) ?></h2>
    <div class="row">
        <div class="col-md-6">
            <img src="<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h3>Description</h3>
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <h3>Details</h3>
            <ul>
                <li>Price: $<?= number_format($product['price'], 2) ?></li>
                <li>Type: <?= htmlspecialchars($product['fk_type']) ?></li>
                <li>Status: <?= $product['fk_status'] == 1 ? 'Active' : 'Inactive' ?></li>
            </ul>
            <a href="product_all.php" class="btn btn-primary">Back to Products</a>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
