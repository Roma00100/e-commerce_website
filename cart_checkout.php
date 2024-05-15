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

$sql_cart = "SELECT 
b.fk_user,
b.fk_product,
b.amount,
p.name,
p.price,
p.img,
u.fname,
u.lname,
u.email,
u.adress

FROM `basket` as b
JOIN product as p on b.fk_product = p.id
JOIN user as u on b.fk_user = u.id 
WHERE fk_user = $user_id AND b.order_date is NULL";

$result_sql_cart = mysqli_query($connect, $sql_cart);

$html_content = "";
$html_content_empty_cart = "";
$total = 0;


if (mysqli_num_rows($result_sql_cart) == 0) {
    $html_content_empty_cart = "
    
    <div class='p-5 text-center'><h2> Your basket is empty </h2></div> ";
} else {

    $cart_rows = mysqli_fetch_all($result_sql_cart, MYSQLI_ASSOC);
    $html_content .= "<div class='row'>";
    // Products
    $html_content .= "<div class='container'>";
    foreach ($cart_rows as $val) {

        $total += $val["amount"] * $val["price"];
        $product_total = $val["amount"] * $val["price"];
        $html_content .= "<div class='card conCus mt-3 mb-3'>
        <div class='row g-0'>
            <div class='col-md-4 p-4'>
                <img class='img-fluid' src='./images/product/{$val['img']}' alt='Product Image' width='50%'>
            </div>
            <div class='col-md-8'>
                <div class='card-body'>
                    <h5 class='card-title'>{$val['name']}</h5>
                    <span class='card-text'>
                    Price: &euro; {$val['price']} | 
                    Quantity: {$val['amount']} | 
                    Total: &euro; {$product_total}
                    </span>
            </div>
        </div>
     </div>
 </div>";
    }
};




$sql_user = "SELECT
`fname`,
`lname`,
`email`,
`adress`
 FROM `user` WHERE id = $user_id";


$result_user = mysqli_query($connect, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);





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
        <link rel="stylesheet" href="./css/cart.css">
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

    <div class="container text-center mt-5 mt-5">
        <h1>Checkout</h1>
    </div>

    <div class="card container coba mb-5 mt-3 p-4 mx-auto">

        <?= $html_content_empty_cart ?>

        <div class='row g-0'>
            <div class='col-md-8'>

                <table class='table'>
                    <div class="mb-2">
                        <?= $html_content ?>
                    </div>
                </table>

            </div>


            <div class='col-md-4'>

                <div class="card shadow p-3 m-2" style='min-height: 250px;'>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row_user['fname'] . ' ' . $row_user['lname'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $row_user['email'] ?></h6>
                        <p class="card-text"><?= $row_user['adress'] ?></p>

                        <a class="btn btn-info" href="./user_edit.php?id=<?= $user_id ?>" class="card-link">Update your details</a>

                        <div class='card container p-4 mt-3 mb-1'>
                            <h6>
                                <span class="card-text">Total Amount</span>
                                <span class="card-text text-end">&euro; <?= $total ?></span>
                            </h6>
                            <br>
                            <small> By clicking the Buy Now button you will be redirected to our payment provider and can pay directly using your preferred payment method!</small>

                        </div>

                        <div class="btn-group">

                            <a class="btn btn-dark" href="./cart.php">Back to cart</a>
                            &nbsp; &nbsp;
                            <a class="btn btn-success" href="./cart_stripe_checkout.php">Buy now</a>

                        </div>
                    </div>
                </div>
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