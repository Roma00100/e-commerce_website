<?php

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $type = htmlspecialchars($_POST['type']);
    $status = htmlspecialchars($_POST['status']);
    $filename = null;
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $allowed = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $filename = $_FILES['img']['name'];
        $filetype = $_FILES['img']['type'];
        $filesize = $_FILES['img']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
        if (in_array($filetype, $allowed)) {
            $uploadPath = "./images/product/";
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $filePath = $uploadPath . $filename;
            if (file_exists($filePath)) {
                echo $filename . ' already exists.';
            } else {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $filePath)) {
                    echo "Your file was uploaded successfully.";
                } else {
                    die("Error: There was a problem uploading your file. Please try again.");
                }
            }
        } else {
            echo "Error: There was a problem with the file format.";
        }
    } else {
        echo "Error: " . $_FILES['img']['error'];
    }
    if ($filename) {
        $sql = "INSERT INTO product (name, description, price, fk_type, fk_status, img) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connect->prepare($sql);
        if (!$stmt) {
            die("MySQL prepare error: " . $conn->error);
        }
        $stmt->bind_param("ssdiis", $name, $description, $price, $type, $status, $filename);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "New product added successfully.";
        } else {
            echo "Error adding new product: " . $stmt->error;
        }
        $stmt->close();
    }
    $connect->close();
}
?><!-- ------------------------------------------------ -->
<!-- ----------------HTML START---------------------- -->
<!-- ------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './components/header.html' ?>
</head>
<?php include '_navbar.php' ?>
<?php include '_navbardash.php' ?>

<body>
    <div class="container">
        <h3 class="text-center p-4 mb-3 ">CREATE PRODUCT</h3>
        <div class="card container bg-body-custom">
            <div class="container p-4">
                <form action="product_create.php" method="post" enctype="multipart/form-data" class="mt-3">
                    <div class="form-group mb-3">
                        <label for="name">Product Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type">Product Type:</label>
                        <select class="form-control" id="type" name="type">
                            <option value="1">Fashion</option>
                            <option value="2">Shoes</option>
                            <option value="3">Accessories</option>
                            <option value="4">Entertainment</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">Visible</option>
                            <option value="2">Hidden</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="img" class="form-label">Product Image:</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-dark">Create New Product</button>
                </form>
            </div>
        </div>
    </div>

    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>

    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->
</body>

</html>