<?php


require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';
session_start();





if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: login.php");  
    exit;
}


if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    echo "Invalid Product ID";
    exit;
}

$product_id = $_GET['id'];


if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $stmt = $connect->prepare("DELETE FROM product WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $execute = $stmt->execute();

    if ($execute) {
        echo "Product deleted successfully.";
        header("Refresh: 2; URL=product_dashboard.php"); 

    } else {
        echo "Error deleting product: " . $conn->error;
    }
    $stmt->close();
} else {
   
    echo "<h2>Confirm Deletion</h2>
          <p>Are you sure you want to delete this product?</p>
          <form method='post'>
              <input type='hidden' name='confirm' value='yes'>
              <button type='submit'>Delete Product</button>
          </form>
          <a href='product_dashboard.php'><button>Cancel</button></a>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
    <!-- Optionally, additional HTML here -->
</body>
</html>
