<?php

session_start();

require_once './php_db/db_connect.php';

$product_id = $_GET['id'] ?? null;
$product = null;
$reviews = [];

if ($product_id) {
    $stmt = $connect->prepare("SELECT p.*, t.type as typeName, s.status as statusName, basket.* FROM product p
                                LEFT JOIN product_type t ON p.fk_type = t.id
                                LEFT JOIN product_status s ON p.fk_status = s.id
                                LEFT JOIN basket ON basket.fk_product = p.id
                                WHERE p.id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<p>No product found for this ID.</p>";
    }
    $stmt->close();

    // Fetch reviews for the product
    $reviewStmt = $connect->prepare("SELECT product_review.review, product_review.rating, product_review.created, user.fname, user.lname, user.user_img
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

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Details</title>
    <?php include './components/header.html' ?>
    <style>
        .rating {
            unicode-bidi: bidi-override;
            direction: ltr;
            font-size: 18px;
            text-align: right;
        }

        .rating>span {
            display: inline-block;
            position: relative;
            width: 1.1em;
        }

        .rating>span:before {
            content: "\2605";
            position: absolute;
            left: 0;
            color: #5e3C58;
        }

        .rating>span.empty:before {
            color: #eee;
        }

        .user-img {
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<body>
    <?php include '_navbar.php' ?>

    <div class="container mt-4 mb-4">
        <div class="container bg-body-custom text-center p-3 mb-4">
            <h3 class="text-uppercase">
                <?php
                if (is_array($product) && isset($product['name'])) {
                    echo htmlspecialchars($product['name']);
                } else {
                    echo "Product name not available";
                }
                ?>
            </h3>
        </div>
    </div>

    <div class="container mt-3 mb-3">
        <div class="card shadow mb-3 p-4" style="max-width: px;">
            <div class="card-container p-4">
                <div class="row justify-content-evenly">
                    <?php if ($product) : ?>
                        <div class="col-md-8 p-4">
                        </div>
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img class='w-100' src='./images/product/<?= $product['img'] ?>' alt='Product Image'>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h3 class="p-2"><?= htmlspecialchars($product['name']) ?></h3>

                                    <h6 class="p-2"><?= htmlspecialchars($product['description']) ?></h6>

                                    <h4 class="p-2">Category: <?= htmlspecialchars($product['typeName']) ?></h4>
                                    <h3 class="p-2">€<?= htmlspecialchars(number_format($product['price'], 2)) ?></h3>
                                    <br />
                                    <div class="container btn-group">
                                        <a class="btn btn-info" href='cart.php?id=<?= $product_id ?>'>add to cart</a>
                                        <?php
                                        if ($product["order_date"] != Null) {
                                        ?>
                                            <a class="btn btn-success" href='review_form.php?id=<?= $product_id ?>'>review</a>
                                        <?php
                                        }
                                        ?>
                                        <a class="btn btn-dark" href='product_all.php'>Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <br>
                </div>
            </div>
            <!-- Display Reviews -->

            <div class="container p-4">
                <h4>Reviews:</h4>
                <div class="card shadow bg-body-custom p-4 mt-3 mb-3">
                    <?php if (count($reviews) > 0) : ?>
                        <?php foreach ($reviews as $review) : ?>
                            <div class="card shadow p-4 mb-3">
                                <div class="card-body">
                                    <img class='user-img' src='./images/user/<?= $review['user_img'] ?>' alt='User Image'>
                                    <p><strong><?= htmlspecialchars($review['fname']) . " " . htmlspecialchars($review['lname']) ?></strong><br>
                                        <small><?= date("d. F Y | H:i", strtotime($review['created'])) ?></small>
                                    </p>


                                    <p>"<?= htmlspecialchars($review['review']) ?>"</p>

                                    <div class="rating">

                                        <?= str_repeat('<span class="filled"></span>', (int)$review['rating']) ?>
                                        <?= str_repeat('<span class="empty"></span>', 5 - (int)$review['rating']) ?>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No reviews yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <p>Product details not found.</p>
<?php endif; ?>
</div>
</div>
</div>

<?php include './components/footer.html' ?>
</body>

</html>