<?php
require_once './php_db/db_connect.php';

$product_id = $_GET['id'] ?? null;
$product = null;

if ($product_id) {
    // Fetch existing product details
    $stmt = $connect->prepare("SELECT p.*, t.type as typeName, s.status as statusName FROM product p
                               LEFT JOIN product_type t ON p.fk_type = t.id
                               LEFT JOIN product_status s ON p.fk_status = s.id
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
} else {
    echo "<p>No product ID provided.</p>";
}
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Details</title>

    <?php include './components/header.html' ?>

</head>

<body>
    <?php include '_navbar.php' ?>

    <div class="container mt-4 mb-4">
        <div class="container text-center p-3 mb-4">
            <h3 class="text-uppercase"><?= htmlspecialchars($product['name']) ?></h3>
        </div>
    </div>

    <div class="card container">

        <div class="card-container p-4">
            <div class="row justify-content-evenly">
                <?php if ($product) : ?>
                    <div class="col-md-8 p-4">
                        <img class='w-100' src='./images/product/<?= $product['img'] ?>' alt='Product Image'>
                    </div>

                    <div class="col-6 col-md-4">
                        <br />

                        <div class="container">

                            <h3 class=""><?= htmlspecialchars($product['name']) ?></h3>

                            <h6 class=""><?= htmlspecialchars($product['description']) ?></h6>

                            <h4>Category: <?= htmlspecialchars($product['typeName']) ?></h4>
                            <h3 class="">€<?= htmlspecialchars(number_format($product['price'], 2)) ?></h3>
                            <br />
                        </div>
                        <br>
                        <div class="container btn-group">
                            <a class="btn btn-info" href='cart.php?id=<?= $product_id ?>'>add to cart</a>

                            <a class="btn btn-outline-dark" href='review_form.php'>review</a>
                            <a class="btn btn-dark" href='product_all.php'>Back</a>

                        </div>
                    </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <p>Product details not found.</p>
<?php endif; ?>
</div>
</div>

<?php include './components/footer.html' ?>
</body>

</html>