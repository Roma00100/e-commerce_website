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


$id = $_SESSION["user"];
$reviews = [];

$sql_user = "SELECT
`fname`,
`lname`,
`email`,
`adress`,
`user_img` FROM `user` WHERE id = $id";

$result_user = mysqli_query($connect, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);

// ---------------------------START----------------------------
// ------------------------ORDER HISTORY ----------------------

$sql_order_history = "SELECT 
    b.fk_user,
    b.fk_product,
    b.amount,
    b.order_date,
    p.name,
    p.price,
    p.img
    FROM `basket` as b
    JOIN product as p on b.fk_product = p.id
    WHERE fk_user = $id AND b.order_date is NOT NULL";

$result_sql_order_history = mysqli_query($connect, $sql_order_history);

$html_content = "";
$total = 0;

if (mysqli_num_rows($result_sql_order_history) == 0) {
    $html_content = "<div class='p-5 text-center'><h2>No order history found.</h2></div>";
} else {
    $order_history_rows = mysqli_fetch_all($result_sql_order_history, MYSQLI_ASSOC);
    $html_content .= "<div class='container'><h4 class='text-center mt-3 text-uppercase'>Shopping History</h4></div><br>";
    foreach ($order_history_rows as $val) {
        $total += $val["amount"] * $val["price"];
        $product_total = $val["amount"] * $val["price"];
        $formattedDateTime = date("d. F Y | H:i", strtotime($val["order_date"]));
        $html_content .= "<div class='card mt-3 mb-3'>
                        <div class='row'>
                             <div class='col p-4 text-center'>
                                <img class='img-fluid' src='./images/product/{$val['img']}' alt='Product Image' width='50%'>
                            </div>
                            <div class='col-md-8'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$val['name']}</h5>
                                <span class='card-text'>
                                    Price: &euro; {$val['price']} | 
                                    Quantity: {$val['amount']} | 
                                    Total: &euro; {$product_total}
                                <br>
                                    Purchase date: {$formattedDateTime}  
                                    </span>
                                    <div class='btn-group'>
                            <a href='product_details.php?id={$val['fk_product']}' class='btn btn-sm btn-outline-dark'>details</a>
                            <a href='review_form.php?id={$val['fk_product']}' class='btn btn-primary'>Leave a Review</a>
                                </div>
                                </div>
                            </div>
                            </div>
                         </div>
                     </div>";
    }
    $reviewStmt = $connect->prepare("SELECT product_review.review, product_review.rating, product_review.created, user.fname, user.lname 
    FROM product_review 
    JOIN user ON product_review.fk_user = user.id 
    WHERE product_review.fk_product = ? 
    ORDER BY product_review.created DESC");
    $reviewStmt->bind_param("i", $product_id);
    $reviewStmt->execute();
    $reviewResult = $reviewStmt->get_result();
    while ($row = $reviewResult->fetch_assoc()) {
        $reviews[] = $row;
    }
    $reviewStmt->close();
}

// ------------------------ORDER HISTORY ----------------------
// -----------------------------END----------------------------
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

    <div class="card shadow p-3 container bg-body-custom mt-5">

        <div class="container text-center mt-4">
            <h3>USER DETAILS</h3>
        </div>

        <div class="container p-4">

            <div class='card mb-5 mt-2 mx-auto' style='max-width: 1080px;'>
                <div class='row g-0'>
                    <div class='col-md-4 p-4'>
                        <img class='w-50' src='./images/user/<?= $row_user['user_img'] ?>' alt='...'>
                    </div>
                    <div class='col-md-8 p-4'>
                        <div class='card-body d-flex flex-column justify-content-start'>

                            <p class='card-text'><strong>First Name: </strong> <?= $row_user['fname'] ?>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><strong>Last Name: </strong> <?= $row_user['lname'] ?>
                            </p>

                            <p strong class='card-text'><strong>Email: </strong> <?= $row_user['email'] ?></p>

                            <p class='card-text'><strong>Address: </strong> <?= $row_user['adress'] ?></p>
                        </div>
                    </div>

                    <div class="container btn-group mb-5">
                        <button class="btn btn-success" onclick="window.location.href='user_edit.php?id=<?= $id ?>'">Update Profile</button>
                        <button class="btn btn-dark" onclick="window.location.href='user_delete.php?id=<?= $id ?>'">Delete User</button>
                        <button class="btn btn-info" onclick="window.location.href='user_logout.php?id=<?= $id ?>'">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <?= $html_content ?>


    <!-- ------------------------------------------------------------ -->
    <!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

    <?php include './components/footer.html' ?>


    <!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
    <!-- ------------------------------------------------------------ -->

</body>

</html>