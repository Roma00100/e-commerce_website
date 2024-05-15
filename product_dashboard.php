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


$sql = "SELECT id, name, description, price,  img FROM product";
$result = $connect->query($sql);


$layout = "";
if ($result && $result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        $layout .= "<div class='col-md-4'>
                        <div class='card mb-4 shadow-sm'>
                            <img src='images/product/{$product["img"]}' alt='{$product["name"]}' class='bd-placeholder-img card-img-top' width='100%' height='100%'>
                            <div class='card-body'>
                                <p class='card-text'>{$product["description"]}</p>
                                <div class='d-flex justify-content-between align-items-center'>
                                    <div class='btn-group'>
                                        
                                        <a href='product_delete.php?id={$product["id"]}' class='btn btn-sm btn-info' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>
                                        <a href='product_update.php?id={$product["id"]}' class='btn btn-sm btn-dark'>update</a>
                                        <a href='product_details_admin.php?id={$product["id"]}' class='btn btn-sm btn-outline-dark'>details</a>
                                    </div>
                                    <small class='text-muted'>{$product["price"]}</small>
                                </div>
                            </div>
                        </div>
                    </div>";
    }
} else {
    $layout = "<p>No products found in the database.</p>";
}

?>













<!-- ------------------------------------------------ -->
<!-- ----------------HTML START---------------------- -->
<!-- ------------------------------------------------- -->


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- ---------------------------------------------------------- -->
    <!-- -------------INCLUDES COMMON HEAD . START----------------- -->



    <?php include './components/header.html' ?>



    <!-- -------------INCLUDES COMMON HEAD . END------------------- -->
    <!-- ---------------------------------------------------------- -->

</head>


<body>




    <!-- ----------------------------------------------------------------- -->
    <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


    <?php include '_navbar.php' ?>

    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->

    <?php include '_navbardash.php' ?>

    <h3 class="text-center p-4 mb-3 ">MANAGE PRODUCTS</h3>
    <div class="container mt-3">
        <div class="row">
            <?= $layout ?>
        </div>
    </div>




    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->




</body>

</html>