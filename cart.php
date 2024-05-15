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

    $sql_checkIfExists = "SELECT * FROM `basket` WHERE fk_product = $product_id AND fk_user = $user_id AND `order_date` is NULL";
    $result_checkIfExists = mysqli_query($connect, $sql_checkIfExists);

    if (mysqli_num_rows($result_checkIfExists) == 0) {

        $sql_add_to_cart = "INSERT INTO `basket`(`fk_user`, `fk_product`, `amount`) VALUES ($user_id, $product_id, $qtty)";
    } else {
        $sql_add_to_cart = "UPDATE basket SET amount = amount + 1 WHERE fk_product = $product_id AND fk_user = $user_id AND order_date IS NULL";
    }
    $result_add_to_cart = mysqli_query($connect, $sql_add_to_cart);
    header("Location:cart.php");
}

$sql_cart = "SELECT 
    b.fk_user,
    b.fk_product,
    b.amount,
    p.name,
    p.price,
    p.img
    FROM `basket` as b
    JOIN product as p on b.fk_product = p.id
    WHERE fk_user = $user_id AND b.order_date is NULL";

$result_sql_cart = mysqli_query($connect, $sql_cart);

$html_content = "";
$total = 0;

if (mysqli_num_rows($result_sql_cart) == 0) {
    $html_content = "<div class='p-5 text-center'><h2>Your shopping cart is empty</h2></div>";
} else {
    $cart_rows = mysqli_fetch_all($result_sql_cart, MYSQLI_ASSOC);
    $html_content .= "<div class='row'>";
    // Products
    $html_content .= "<div class='col-md-8'>";
    foreach ($cart_rows as $val) {
        $total += $val["amount"] * $val["price"];
        $product_total = $val["amount"] * $val["price"];
        $html_content .= "<div class='card conCus mt-3 mb-3'>
                            <div class='row g-0'>
                                <div class='col-md-4 p-4'>
                                    <img class='img-fluid' src='./images/product/{$val['img']}' alt='Product Image' width='75%'>
                                </div>
                                <div class='col-md-8'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>{$val['name']}</h5>
                                        <span class='card-text'>
                                        Price: &euro; {$val['price']} | 
                                        Quantity: {$val['amount']} | 
                                        Total: &euro; {$product_total}
                                        </span>

                                        <div class='btn-group'>
                                         <a href='cart_add.php?id={$val['fk_product']}' class='btn btn-success'>Add Item</a>
                                        <a href='cart_delete.php?id={$val['fk_product']}' class='btn btn-dark'>Delete Item</a>
                                        
                                     </div>
                                </div>
                            </div>
                         </div>
                     </div>";
    }
    $html_content .= "</div>";
    // Products
    $html_content .= "<div class='col-md-4 mt-3'>
                    <div class='card summary mb-3'>
                        <div class='card-body'>
                            <h3 class='card-title mb-4'>Summary</h3>
                            <h6 class='card-text'>Total Items: " . count($cart_rows) . "</h6>
                            <h6 class='card-text'>Total Price: &euro; {$total}</h6>
                            <a href='cart_checkout.php' class='btn btn-dark'>Checkout</a>
                            <a href='product_all.php' class='btn btn-outline-dark'>Back to Shop</a>
                     </div>
                </div>
            </div>";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <?php include './components/header.html' ?>
    <link rel="stylesheet" href="./css/cart.css">

</head>

<body>

    <?php include '_navbar.php' ?>

    <div class="container text-center mt-5 mt-5">
        <h1>Shopping Cart</h1>
    </div>
    <div class="container mt-3">
        <?= $html_content ?>
    </div>
    </div>

    <?php include './components/footer.html' ?>
</body>

</html>