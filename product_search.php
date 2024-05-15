<?php



require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';



session_start();

if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
}


$search_value = $_GET['search'];

$sql_search = "SELECT
p.id,
p.name,
p.description,
p.price,
p.img,
p.fk_type,
pt.type

FROM `product` as p
JOIN `product_type` as pt on fk_type = pt.id

WHERE (p.name LIKE '%$search_value%' OR pt.type LIKE '%$search_value%')
    AND p.fk_status = 1";

$result_search = mysqli_query($connect, $sql_search);
// $row_search = mysqli_fetch_all($result_search, MYSQLI_ASSOC);


$layout = "";
if ($result_search && $result_search->num_rows > 0) {
    while ($product = $result_search->fetch_assoc()) {
        $layout .= "<div class='cards'>
        <figure class='image-block'>
              <img src='./images/product/{$product["img"]}' alt='{$product["name"]}'> 
              <figcaption>            
              <h5 class='card-text text-uppercase'>{$product["name"]}</h5>
             <h5 class='card-text'>€ {$product["price"]}</h5><br>
            <div class='d-flex justify-content-between align-items-center'>
            <a class=' btn-miro' href='product_details.php?id={$product["id"]}'>Details</a>
                     <a class=' btn-miro' href='cart.php?id={$product["id"]}'>Add to cart</a>
                                </div>
                                </div>
                            </figcaption>
                            </figure>";
    }
} else {
    $layout = "<h3>No product found</h3>";
}

?>













<!-- ------------------------------------------------ -->
<!-- ----------------HTML START---------------------- -->
<!-- ------------------------------------------------- -->


<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .card:hover {
            transform: scale(1.03);
            transition: .3s transform ease-in-out;
        }
    </style>
    <!-- ---------------------------------------------------------- -->
    <!-- -------------INCLUDES COMMON HEAD . START----------------- -->



    <?php include './components/header.html' ?>
    <link rel="stylesheet" href="./css/product.css">



    <!-- -------------INCLUDES COMMON HEAD . END------------------- -->
    <!-- ---------------------------------------------------------- -->

</head>


<body>




    <!-- ----------------------------------------------------------------- -->
    <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


    <?php include '_navbar.php' ?>

    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->




    <div class="container text-center mt-5 mb-4">
        <div class="header mt-5 mb-5">
            <h1 class="my-3">Shop The Products</h1>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1">
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