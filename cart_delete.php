<?php

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: user_login.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
}

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';



$user_id = $_SESSION['user'];

if (isset($_GET['id'])) {

    $product_id = $_GET['id'];
    $user_id = $_SESSION['user'];
    $qtty = 1;

    $sql_select_for_delete = "SELECT * FROM `basket` WHERE fk_product = $product_id AND fk_user = $user_id AND `order_date` is NULL";
    $result_select_for_delete = mysqli_query($connect, $sql_select_for_delete);
    $row_select_for_delete = mysqli_fetch_assoc($result_select_for_delete);

    // var_dump($row_select_for_delete);
    // exit();

    if (($row_select_for_delete['amount']) > 1) {
        $sql_delete_from_cart = "UPDATE basket SET amount = amount - 1 WHERE fk_product = $product_id AND fk_user = $user_id AND order_date IS NULL";
    } else {

        $sql_delete_from_cart = "DELETE FROM `basket` WHERE fk_product = $product_id AND fk_user = $user_id AND order_date IS NULL";
    }
    $result_delete_from_cart = mysqli_query($connect, $sql_delete_from_cart);
    header("Location:cart.php");
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


    <head>
        <?php include './components/header.html' ?>
    </head>


    <!-- -------------INCLUDES COMMON HEAD . END------------------- -->
    <!-- ---------------------------------------------------------- -->

</head>


<body>


    <!-- ----------------------------------------------------------------- -->
    <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


    <?php include '_navbar.php' ?>

    <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
    <!-- ----------------------------------------------------------------- -->








    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->

</body>

</html>