<?php

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';

$id = $_GET["id"];

$sql = "SELECT * FROM `product` WHERE id = {$id}";

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $name = $_POST["description"];
    $price = $_POST["price"];
    $type = $_POST["type"];
    $picture = fileUpload($_FILES["picture"]);

    if ($_FILES["picture"]["error"] == 4) {
        $sqlUpdate = "UPDATE `product` SET `name`='{$name}',`price`='{$price}' WHERE id = {$id}";
    } else {
        $sqlUpdate = "UPDATE `product` SET `name`='{$name}',`price`='{$price}',picture = '{$picture[0]}' WHERE id = {$id}";
    }

    $result = mysqli_query($connect, $sqlUpdate);

    if ($result) {
        echo "<div class='alert alert-success' role='alert'>
        Product has been updated!, {$picture[1]}
      </div>";
        header("refresh: 3; url= index.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        Something went wrong, please try again later!
      </div>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './components/header.html' ?>
</head>

<body>

    <?php include '_navbar.php' ?>
    <?php include '_navbardash.php' ?>


    <div class="container mt-4">
        <div class="container text-center p-3 mb-3">
            <h3 class="">UPDATE PRODUCT</h3>
        </div>

        <div class="card container bg-body-custom">
            <div class="container p-4">
                <div class="text-center">
                    <img src="images/product/<?= htmlspecialchars($row["img"]) ?>" alt="Product Image" width="150">
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Product name" name="name" value="<?= htmlspecialchars($row["name"]) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" placeholder="Product description" name="description" required><?= htmlspecialchars($row["description"]) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" placeholder="Product price" name="price" value="<?= htmlspecialchars($row["price"]) ?>" required step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="type">Product Type:</label>
                        <select class="form-control" id="type" name="type">
                            <option value="1" <?= $row["fk_type"] == 1 ? "selected" : "" ?>>Fashion</option>
                            <option value="2" <?= $row["fk_type"] == 2 ? "selected" : "" ?>>Shoes</option>
                            <option value="3" <?= $row["fk_type"] == 3 ? "selected" : "" ?>>Accessories</option>
                            <option value="4" <?= $row["fk_type"] == 3 ? "selected" : "" ?>>Entertainment</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="picture">Product Image:</label>
                        <input type="file" class="form-control-file" id="picture" name="picture">
                    </div>
                    <br>
                    <button class="btn btn-dark" type="submit" name="update">Update Product</button>
                </form>
            </div>
        </div>
    </div>
    <?php include './components/footer.html' ?>

</body>

</html>